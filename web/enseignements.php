<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Projet Web</title>
    </head>
    <body>
        <h1>Services du Département d'Economie</h1>
        <p>Liste des enseignements</p>

        <table>
            <thead>
                <tr>
                    <th>Apogee</th>
                    <th>Intitule</th>
                    <th>heureCM</th>
                    <th>heureTP</th>
                    <th>nbGroupes</th>
                    <th>heureTotale</th>
                    <th>heureAffecteCM</th>
                    <th>heureAffecteTP</th>
                    <th>semestre</th>
                    <th>formation</th>
                    <th>diplome</th>
                </tr>
            </thead>
            <tbody>
                <!-- trouver un moyen pour extraire les noms des champs sans avoir à les écrire à la mano -->
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
                // PDO::FETCH_ASSOC pour obtenir un tableau associatif
                while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<tr>";
                    foreach ($donnees as $key => $value) {
                        echo  "<td>" .$value."</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
