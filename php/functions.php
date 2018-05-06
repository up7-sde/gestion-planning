<?php
/**
 * Retourne un tableau au format html à partir
 * d'un tableau associatif fournit en param
 * Affiche un message si le tableau est vide
 * debug : a mons avis la vérification doit se faire autre part
 */
 function ecrireTab($tableau)
 {
     if (!empty($tableau))
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
     }
     else
     {
         $html = "<p>Tableau vide<p>";
     }

     return $html;
 }

 ?>
