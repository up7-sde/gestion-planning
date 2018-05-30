<?php

include_once('Controller.php');

/*
 * Affiche la liste de l'ensemble des services
 */
class ServiceListeController extends Controller {

    public function render($args=null){
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
         // Get sans argument : vue de la liste
        $title = "Service";
        $pageTitle = "Service | " . $user['name'];
        $tab = $this->db->getAllService();
        include('view/TabView.php');
    }
}
