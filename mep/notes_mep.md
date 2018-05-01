# Notes pour la mise en production de l'application web

> Explique les procédures et documente le script bash d'installation.


## 1. Création des variables d'environnements

Ce fichier contient beaucoup de données sensibles : il est donc listé dans le .gitignore.
A la place on laissera un template (qu'il suffiera de mettre à jour).

usage :

    source creer_variable_environnement.sh

## 2. Installation de la BDD

cf [documentation officielle](https://dev.mysql.com/doc/refman/8.0/en/mysql-batch-commands.html), usage :

    mysql db_name < projet/bdd/creation_bdd.sql
