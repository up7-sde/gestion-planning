<?php

include_once('Controller.php');

//class Home extends Controller
class ServiceGetController extends Controller {

    public function render($args=null){
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
         // Get sans argument : vue de la liste
        if ($args == null)
        {
          $title = "Service";
          $pageTitle = "Service | " . $user['name'];
          $tab = $this->db->getAllService();
          $prefix = 'service/'; // permettra de générer des liens dynamiquement
          include('view/TabView.php');
        }
        // Get avec argument : vu du formulaire
        else {
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
}
