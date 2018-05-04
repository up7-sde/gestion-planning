<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Projet Web</title>
    </head>
    <body>
        <h1>Services du Département d'Economie</h1>
        <p>Liste des enseignements</p>
        <?php
        try
        {
        	$bdd = new PDO('mysql:host=localhost;dbname=sde;charset=utf8', 'admin', 'wqa&2ZSX');
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
        $reponse = $bdd->query("CALL SelectionnerEnseignements()");
        while ($donnees = $reponse->fetch())
        {
          echo "<li>" . $donnees['apogee'] . " " . $donnees['intitule'] . "</li><br><br>";
        }
        ?>
    </body>
</html>
