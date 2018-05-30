<?php

include_once('Controller.php');

// Affiche un service sous la forme d'un formulaire
class ServiceAfficherController extends Controller {
    public function render($args=null){
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
        $thisServiceid = $args;
        $title = "Service id " . $thisServiceid;
        $pageTitle = "Service $thisServiceid | " . $user['name'];
        $data = $this->db->getService($thisServiceid);
        $data = $data[0]; // retourne une liste dans laquelle seule la 1ere ligne nous intéresse
        // Extraire les labels pour le formulaire
        $labelEnseignant = $this->db->getLabelEnseignant();
        $labelEnseignement = $this->db->getLabelEnseignement();
        $labelTypeService = $this->db->getLabelTypeService();
        include('view/FormService.php');
    }
}
