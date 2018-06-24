#!/bin/bash

# A lancer sur un serveur avec la commande :
#ssh sde@ip 'bash -s' < deployer.sh

# Récupérer la branche à déployer passée en paramètre
branche=$1

echo "Se depalcer dans le bon dossier"
cd ~/sites/sde

echo "Sourcer et afficher les variables d'environnement"
source mep/.env
printenv

echo "Supprimer tous les changements pour être certain de pouvoir faire le pull"
git reset --hard HEAD
echo "Obtenir les dernières sources de la branche master"
git pull origin $branche

echo "Changer les mots de passe par les mots de passe issus des variables d'env"
sed -i -e "s/mdpadmin/$ADMIN_MYSQL_PASSWD/g" "$DIR_BDD/creer_bdd.sql"
sed -i -e "s/mdpenseignant/$ENSEIGNANT_MYSQL_PASSWD/g" "$DIR_BDD/creer_bdd.sql"

echo "Changer l'adresse du serveur, par défaut sur localhost pour le dev"
sed -i -e "s/\$server=\"localhost\"/$SERVER/g" "web/controller/Controller.php"

echo "Supprimer les suffixe /web des urls écrit en dure dans le code lors du dev"
cd ~/sites/sde/web
grep -rli '/web' * | xargs -i@ sed -i 's/\/web//g' @

echo "Installer la base de données"
cat "$DIR_BDD/creer_bdd.sql"| $MYSQL -u $ROOT_MYSQL_LOGIN -p$ROOT_MYSQL_PASSWD
