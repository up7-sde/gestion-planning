

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class RoutinesGETController extends Controller {
    
    public function render($args=null){
   
        $this->namespace = 'Nouvelle année';
        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth?action=process');
        
        $this->pageType = 'Routine';
        $this->title = 'Nouvelle année';
        
        $titleButton = null;

        $formInputs = array(
            'annee1' =>null,
            'annee2' => null
        );

        $formActions = array('form' => '/web/routines/nvelleannnee', 'back' => '/web' . $this->getLastDifferentUrl()); 
        
        $hiddenInput = null;  
        
        $this->data = array(array('annee1' => date("Y"), 'annee2' => intval(date("Y"))+1));

        include('view2/forms.php'); 
    }
}
?>