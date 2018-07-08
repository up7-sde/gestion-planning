

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class RoutinesGETController extends Controller {
    
    public function render($args=null){
   
        $this->namespace = 'Reconduire';
        /*verifier auth*/
        $user = $this->auth->getUserInfos();

        if (!$user) $this->request->redirect('/auth?action=process');
        if (!$this->auth->isUserAdmin()) $this->request->force('401');
        
        $this->pageType = 'Routine';
        $this->title = 'Reconduire';
        
        $titleButton = null;

        $formInputs = array(
            'annee1' =>null,
            'annee2' => null
        );

        $formActions = array('form' => '/web/routines/nvelleannee', 'back' => '/web' . $this->request->getLastDifferentUrl()); 
        
        $hiddenInput = null;  
        
        $this->data = array(array('annee1' => date("Y"), 'annee2' => intval(date("Y"))+1));

        include('view2/forms.php'); 
    }
}
?>