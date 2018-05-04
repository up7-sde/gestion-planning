# notes php

> Documente l'ensemble des problèmes recontrés en php

## PDO

On obtenait toutes les infos en double en appelant la procédure :

    $reponse = $bdd->query("CALL SelectionnerEnseignements()");

Il faut ajouter PDO::FETCH_ASSOC dans le fetc() pour obtenir un tableau associatif cf [issue](https://stackoverflow.com/questions/24921736/pdo-prepared-statement-fetch-returning-double-results)

    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))

## Extraire le nom des champs d'une table

Il trouver un moyen pour extraire les noms des champs sans avoir à les écrire à la mano
