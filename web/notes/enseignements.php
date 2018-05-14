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
        require("../php/class.php");

        // Obtenir les infos de connexion à la bdd via les variables d'environnement
        $bdd = getenv('BDD');
        $password = getenv('ADMIN_MYSQL_PASSWD');
        $user = getenv('ADMIN_MYSQL_LOGIN');
        
        $dbbManager = new DBManager('mysql:host=localhost;dbname='. $bdd .';charset=utf8', $user, $password);
        $enseignements = $dbbManager->obtenirEnseignements();
        $tabEnseignements = ecrireTab($enseignements);
        echo $tabEnseignements;
        ?>
        <a href="index.php">retour</a>
    </body>
</html>
