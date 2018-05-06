<?php

/**
 * Chargé d'instancier une connection avec la base de donnée via la class PDO
 * Ensuite sert le résultat de requête a travers des méthodes :
 * - obtenirEnseignements,
 * - obtenirEnseignants,
 * ...
 */
class DDBManager
{
    function __construct()
    {
        try
        {
            $this->bdd = new PDO('mysql:host=localhost;dbname=sde;charset=utf8', 'admin', 'wqa&2ZSX');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Retour la liste des enseignements sous forme de tableau associatif
    function obtenirEnseignements()
    {
        $reponse = $this->bdd->query("CALL SelectionnerEnseignements()");
        $donnees = $reponse->fetchAll(PDO::FETCH_ASSOC);
        return $donnees;
    }
}

/**
 * Retourne un tableau associatif formaté en html
 */
 function ecrireTab($tableau)
 {
     // Ecrire le nom des champs du tableau
     $html = "<table><thead><tr>";
     foreach ($tableau[0] as $champ => $value) {
         $html .= "<th>" . $champ . "</th>";
     }
     $html .= "</tr></thead>";

     // Ecrire les lignes du tableau
     $html .= "<tbody>";
     foreach ($tableau as $ligne){
         $html .= "<tr>";
         foreach ($ligne as $champ => $valeur ) {
             $html.= "<td>" . $valeur . "</td>";
            //  echo '<br>DEBUG $champ: ' . $champ . ' ,$valeur : ' . $valeur . "<br>";
         }
         $html .= "</tr>";
     }
     $html .= "</tbody></table>";

     return $html;
 }

 ?>
