<?php

include_once('Controller.php');

//class Home extends Controller
class FormationController extends Controller {

    public function render($args=null){
        $user = $this->getUserInfos();
        $pageTitle = "Formation | " . $user['name'];
        $title = "Formation";
        if (!$user) $this->redirect('/auth/login');
        $tab = $this->db->getAllFormation();

        // appelle la vu correspondante (pour l'instant la vue de base, à modifier)
        include('view/TabView.php');
    }
}
