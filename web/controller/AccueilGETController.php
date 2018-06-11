<?php

include_once('Controller.php');

/*
 *
 */
class AccueilGETController extends Controller {
    public function render($args=null){
        
        $this->namespace = 'Accueil';
        $this->title = 'Accueil';

        $user = $this->getUserInfos();
        
        if (!$user) $this->redirect('/auth?action=process');

        $titleButton = null;
        
        include('view2/accueil.php');
    }
}
