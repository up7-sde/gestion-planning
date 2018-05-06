# notes php

> Documente l'ensemble des problèmes recontrés en php

## PDO

On obtenait toutes les infos en double en appelant la procédure :

    $reponse = $bdd->query("CALL SelectionnerEnseignements()");

Il faut ajouter PDO::FETCH_ASSOC dans le fetc() pour obtenir un tableau associatif cf [issue](https://stackoverflow.com/questions/24921736/pdo-prepared-statement-fetch-returning-double-results)

    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))

## La Classe DBManager

Cette classe repose sur la classe PDO et permet d'écrire toute les requêtes SQL (des applels à des procédures essentiellement) dans un seul endroit ! Il y a 2 types de DBManager (pour distinguer la connection à la base de donnée en tant qu'admin et enseignant)

A la fin on n'a plus qu'à l'instancier et à lancer une de ses méthodes pour obtenir ce que l'on souhaite :

$dbbManager = new DBManager('infodb', 'username', 'password');
$enseignements = $dbbManager->obtenirEnseignements();
