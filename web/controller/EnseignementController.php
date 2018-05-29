<?php

include_once('Controller.php');

//class Home extends Controller
class EnseignementController extends Controller {

    public function render($args=null){
        $user = $this->getUserInfos();
        $pageTitle = "Enseignement | " . $user['name'];
        $title = "Enseignement";
        if (!$user) $this->redirect('/auth/login');
        $tab = $this->db->getAllEnseignement();

        // appelle la vu correspondante (pour l'instant la vue de base, à modifier)
        include('view/TabView.php');
    }
}
