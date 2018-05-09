#!/bin/bash

################################
# INSTALLER LA BASE DE DONNEES #
################################

# Creer le script en production on n'aura plus qu'un seul script mais pour
# le dev c'est plus simple de travailler avec des fichiers séparés :
# - creer la base de données
# - ajouter les droits (a faire dans MysqlWorkbench mais ça ne fonctionne pas pour l'instant)
# - remplir les tables
cat "$DIR_BDD/creer_bdd.sql" "$DIR_BDD/donner_droit.sql" "$DIR_BDD/remplir_bdd.sql" > toto.sql
# Lancer le script avec le compte root
$MYSQL -u $ROOT_MYSQL_LOGIN -p$ROOT_MYSQL_PASSWD < toto.sql
# rm toto.sql
# Tester les procédures avec l'user applicatif admin
$MYSQL -u $ADMIN_MYSQL_LOGIN -p$ADMIN_MYSQL_PASSWD $BDD < "$DIR_BDD/tester_procedures.sql"
