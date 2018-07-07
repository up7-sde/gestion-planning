<?php

include_once('Controller.php');

/*
 *
 */
class AccueilGETController extends Controller {
    public function render($args=null){
        
        $this->namespace = 'Accueil';
        $this->title = 'Avancement du projet';
        $this->pageType = 'Home';

        $user = $this->auth->getUserInfos();
        
        if (!$user) $this->request->redirect('/auth?action=process');

        $titleButton = null;
        
        include('view2/accueil.php');
    }
}