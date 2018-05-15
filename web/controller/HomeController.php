<?php

include_once('Controller.php');

//class Home extends Controller
class HomeController extends Controller {

    public function render(){

        $user = $this->getUserInfos();
        
        if (!$user) $this->redirect('/auth/login');

        // Debug : temporaire j'instanci un db ici pour faciliter le dev (utiliser le service bdd par la suite)
        
        $tab = $this->db->query("SelectionnerEnseignements"); 

        // appelle la vu correspondante (pour l'instant la vue de base, à modifier)
        include('view/HomeView.php');
    }
}