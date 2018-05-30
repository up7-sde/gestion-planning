<?php

include_once('Controller.php');

//  la liste des services
class ServiceListeController extends Controller {

    public function render($args=null){
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
         // Get sans argument : vue de la liste
        $title = "Service";
        $pageTitle = "Service | " . $user['name'];
        $tab = $this->db->getAllService();
        $prefix = 'service/'; // permettra de générer des liens dynamiquement
        include('view/TabView.php');
    }
}
