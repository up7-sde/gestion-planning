<?php

include_once('Controller.php');

//class Home extends Controller
class HomeController extends Controller {

    public function render($args=null){
        $user = $this->getUserInfos();
        $pageTitle = "Home | " . $user['name'];
        $title = "Home";
        $tab = null; // debug envoyer un tableau vide pour home
        if (!$user) $this->redirect('/auth/login');
        include('view/HomeView.php');
    }
}
