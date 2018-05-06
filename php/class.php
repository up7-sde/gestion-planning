<?php

/**
 * Chargé d'instancier une connection avec la base de donnée via la class PDO
 * Ensuite sert le résultat de requête a travers des méthodes :
 * - obtenirEnseignements,
 * - obtenirEnseignants,
 * ...
 */
class DBManager
{
    function __construct($db, $user, $password)
    {
        try
        {
            $this->bdd = new PDO($db, $user, $password);
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Retourne la liste des enseignements sous forme de tableau associatif
    public function obtenirEnseignements()
    {
        $reponse = $this->bdd->query("CALL SelectionnerEnseignements()");
        $donnees = $reponse->fetchAll(PDO::FETCH_ASSOC);
        return $donnees;
    }

    // Retourne la liste des cours pour une année
    public function obtenirCours($annee)
    {
        $reponse = $this->bdd->query("CALL SelectionnerCours(". $annee . ")");
        $donnees = $reponse->fetchAll(PDO::FETCH_ASSOC);
        return $donnees;
    }
}
?>
