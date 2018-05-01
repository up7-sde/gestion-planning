# Notes pour la mise en production de l'application web

> Explique les procédures et documente le script bash d'installation.


## Création de la BDD

cf [documentation officielle](https://dev.mysql.com/doc/refman/8.0/en/mysql-batch-commands.html) :

    mysql db_name < projet/bdd/creation_bdd.sql

## Utiliser des variables d'environnement pour les mdp (mysql/admin du site/etc.)
