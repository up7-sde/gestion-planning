<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class FormationsPOSTController extends Controller {
    public function render($args=null){
        
        /*verifier auth*/
        $user = $this->auth->getUserInfos();
        if (!$user || !$this->auth->isUserAdmin()) $this->request->force('401');
        
        /*on récupère les params => l'id de la ressource*/
        $params = $this->request->getParams();
        
        /*
        case
        /cours => ajoute une nouvelle ressource
        */
        if (!$params){
            $this->csrf->verifyToken();
            
            $this->sanitizer->filter(); 
            
            $res = $this->db->callProcedure('InsererFormation', $_POST);
            
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Formation ajoutée'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));                        
            }
            //$_SESSION["message"] = $res;                    
            $this->request->redirect('/formations?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {
            $this->csrf->verifyToken();
            
            $this->sanitizer->filter(); 
            
            $res = $this->db->callProcedure('ModifierFormation', $_POST);

            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Formation modifiée'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));                        
            }
            
            $this->request->redirect('/formations?action=show');
        }
    }
}
?>