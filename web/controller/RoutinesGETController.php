

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class RoutinesGETController extends Controller {
    
    public function render($args=null){
   
        
        /*verifier auth*/
        $user = $this->auth->getUserInfos();

        if (!$user) $this->request->redirect('/auth?action=process');
        if (!$this->auth->isUserAdmin()) $this->request->force('401');
        
        $this->pageType = 'Routine';
        
        if (preg_match('/nvelle/', $this->request->getCurrentUrl())){

            $this->title = 'Reconduire année';
            $this->namespace = 'Reconduire année';
    
            $titleButton = null;
    
            $formInputs = array(
                'annee1' =>$this->db->findAll('VueLabelAnnee'),
                'annee2' => null
            );
    
            $formActions = array('form' => '/web/routines/nvelleannee', 'back' => '/web' . $this->request->getLastDifferentUrl()); 
            
            $hiddenInput = null;  
            
            $this->data = null;

        } else {

            $this->title = 'Supprimer année';
            $this->namespace = 'Supprimer année';
    
            $titleButton = null;
    
            $formInputs = array(
                'annee1' =>$this->db->findAll('VueLabelAnnee')
            );
    
            $formActions = array('form' => '/web/routines/suppannee', 'back' => '/web' . $this->request->getLastDifferentUrl()); 
            
            $hiddenInput = null;  
            
            $this->data = null;
        }
        
        include('view2/forms.php'); 
    }
}
?>