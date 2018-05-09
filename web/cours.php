<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Projet Web</title>
    </head>
    <body>
        <h1>Services du Département d'Economie</h1>
        <h2>Liste des cours</h2>
        <?php
        // Importer les fonctions et classes
        require("../php/functions.php");
        require("../php/class.php");

        $dbbManager = new DBManager('mysql:host=localhost;dbname=sde;charset=utf8', 'admin', 'wqaZSX23!');
        // Obtenir la liste des cours en fonction de l'année passé en parametre dans l'url
        $cours = $dbbManager->obtenirCours($_GET["annee"]);
        // Afficher le tableau au format html
        echo ecrireTab($cours);
        ?>
        <a href="index.php">retour</a>
    </body>
</html>
