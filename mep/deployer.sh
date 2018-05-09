#!/bin/bash

# Se mettre dans le bon dossier (a décommenter en prod)
#cd ~/sites/sde

# Sourcer les variable d'environnement
source mep/.env

# Obtenir les dernières sources de la branche master (a décommenter en prod)
#git pull origin master

# Changer les mots de passe par les mots de passe issu des variables d'env
sed -i -e "s/mdpadmin/$ADMIN_MYSQL_PASSWD/g" "$DIR_BDD/creer_bdd.sql"
sed -i -e "s/mdpenseignant/$ENSEIGNANT_MYSQL_PASSWD/g" "$DIR_BDD/creer_bdd.sql"

# Installer la base de données (a enlever quand la bdd sera finalisée)
cat "$DIR_BDD/creer_bdd.sql" "$DIR_BDD/donner_droit.sql" "$DIR_BDD/remplir_bdd.sql" > "$DIR_BDD/toto.sql"
$MYSQL -u $ROOT_MYSQL_LOGIN -p$ROOT_MYSQL_PASSWD < "$DIR_BDD/toto.sql"

# Supprimer le fichier temp toto
rm "$DIR_BDD/toto.sql"

# TEST (a commenter en prod)

# Tester les procédures avec l'user applicatif admin
$MYSQL -u $ADMIN_MYSQL_LOGIN -p$ADMIN_MYSQL_PASSWD $BDD < "$DIR_BDD/tester_procedures.sql"
