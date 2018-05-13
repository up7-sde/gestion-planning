#!/bin/bash

# Se mettre dans le bon dossier
cd ~/sites/sde

# Sourcer les variable d'environnement
source mep/.env

# Supprimer tous les changements pour être certain de pouvoir faire le pull
git checkout .
# Obtenir les dernières sources de la branche master
git pull origin master

# Changer les mots de passe par les mots de passe issus des variables d'env
sed -i -e "s/mdpadmin/$ADMIN_MYSQL_PASSWD/g" "$DIR_BDD/creer_bdd.sql"
sed -i -e "s/mdpenseignant/$ENSEIGNANT_MYSQL_PASSWD/g" "$DIR_BDD/creer_bdd.sql"

# Installer la base de données (a enlever quand la bdd sera finalisée)
cat "$DIR_BDD/creer_bdd.sql" "$DIR_BDD/donner_droit.sql" "$DIR_BDD/remplir_bdd.sql" | $MYSQL -u $ROOT_MYSQL_LOGIN -p$ROOT_MYSQL_PASSWD
