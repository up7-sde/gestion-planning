<?php

include_once('Controller.php');

//class Home extends Controller
class EnseignantController extends Controller {

    public function render($args=null){
        $user = $this->getUserInfos();
        $title = "Enseignant";
        $pageTitle = "Enseignant | " . $user['name'];
        if (!$user) $this->redirect('/auth/login');
        $tab = $this->db->getAllEnseignant();

        // appelle la vu correspondante (pour l'instant la vue de base, à modifier)
        include('view/TabView.php');
    }
}
