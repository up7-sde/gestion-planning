<?php

include_once('Controller.php');

/*
 * Afficher un Service sous la forme d'un formulaire
 */
class ServiceAfficherController extends Controller {
    public function render($args=null){
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');


        if ($args != null) // Affichage d'un service existant
        {
          $thisServiceid = $args[0];
          $title = "Service id " . $thisServiceid;
          $pageTitle = "Service $thisServiceid | " . $user['name'];
          $data = $this->db->getService($thisServiceid);
          $data = $data[0]; // retourne une liste d'un seul élément
          // debug : obtenir l'url de manière dynamique
          $action = "/web/modifier/service/$thisServiceid"; // action du form
        }
        else { // Affichage d'un nouveau service : formulaire vide
          $title = "Nouveau service ";
          $pageTitle = " Nouveau service | " . $user['name'];
          $action = "/web/ajouter/service"; // debug adresse dynamique
        }
        // Extraire les labels pour le formulaire
        $labelEnseignant = $this->db->getLabelEnseignant();
        $labelEnseignement = $this->db->getLabelEnseignement();
        $labelTypeService = $this->db->getLabelTypeService();
        include('view/FormService.php');
    }
}
