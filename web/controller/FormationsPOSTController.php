<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class FormationsPOSTController extends Controller {
    public function render($args=null){
        
        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
        
        /*on récupère les params => l'id de la ressource*/
        $params = $this->getParams();
        
        /*
        case
        /cours => ajoute une nouvelle ressource
        */
        if (!$params){
            
            $res = $this->db->callProcedure('InsererFormation', $_POST);
            
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Success_Formation ajoutée'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Fail_Echec de la requête'));                        
            }
            //$_SESSION["message"] = $res;                    
            $this->redirect('/formations?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {
            
            $res = $this->db->callProcedure('ModifierFormation', $_POST);

            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Success_Formation modifiée'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Fail_Echec de la requête'));                        
            }
            
            $this->redirect('/formations?action=show');
        }
    }
}
?>