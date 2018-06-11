

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class ReglagesGETController extends Controller {
    
    public function render($args=null){
   
        
        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth?action=process');
        
        /*on récupère tous les types de params*/
        $extraParams = $this->getExtraParams();
        
        /*injection possible ici*/
        if (!!$extraParams && isset($extraParams['color'])){ 
            $_SESSION['passport']['color'] = ' '.$extraParams['color'].' ';
            $this->redirect($this->getLastUrl());
        }
    }
}
?>