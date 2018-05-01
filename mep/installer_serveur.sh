#!/bin/bash

# Définir les chemins (à modifier pour la production)
DIR_BIN=/opt/lampp/bin
DIR_PROJET=/home/fromdanut/www/projet/
DIR_BDD="$DIR_PROJET/bdd"
ROOT_MYSQL_PASSWD=wide-pratt-jejune-slim

# concatener les scripts de création de la bdd et de remplissaga et lance le résultat le compte root
# en production on n'aura plus qu'un seul script mais pour le dev c'est plus simple de travailler
# avec des fichiers séparés.
cat "$DIR_BDD/creer_bdd.sql" "$DIR_BDD/remplir_bdd.sql" "$DIR_BDD/tester_procedures.sql"> toto.sql
"$DIR_BIN/mysql" -u root -p$ROOT_MYSQL_PASSWD < toto.sql
# rm toto.sql
