<?php

include_once('Controller.php');

/*
 *
 */
class AccueilGETController extends Controller {
    public function render($args=null){
        
        $user = $this->getUserInfos();
        
        if (!$user) $this->redirect('/auth?action=process');
        
        $pageTitle = "Home | " . $user['name'];
        $title = "Home";
        $tab = null;

        include('view/HomeView.php');
    }
}
