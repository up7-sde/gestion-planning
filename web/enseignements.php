<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Projet Web</title>
    </head>
    <body>
        <h1>Services du Département d'Economie</h1>
        <h2>Liste des enseignements</h2>
        <?php
        // Importer les fonctions et classes
        require("../php/functions.php");

        $dbbManager = new DDBManager();
        $enseignements = $dbbManager->obtenirEnseignements();
        $tabEnseignements = ecrireTab($enseignements);
        echo $tabEnseignements;
        ?>
        <a href="index.php">retour</a>
    </body>
</html>
