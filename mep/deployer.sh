#!/bin/bash

# Se mettre dans le bon dossier
cd ~/sites/sde

# Sourcer les variable d'environnement
source mep/.env

# Obtenir les dernières sources de la branche master
git pull origin master

# Recharger la dernière base de données (a enlever quand la bdd sera finalisée)
cat "$DIR_BDD/creer_bdd.sql" "$DIR_BDD/donner_droit.sql" "$DIR_BDD/remplir_bdd.sql" | $MYSQL -u $ROOT_MYSQL_LOGIN -p$ROOT_MYSQL_PASSWD
