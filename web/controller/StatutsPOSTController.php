<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class StatutsPOSTController extends Controller {
    public function render($args=null){
        
        /*verifier auth*/
        $user = $this->auth->getUserInfos();
        if (!$user || !$this->auth->isUserAsmin()) throw new Exception('401');
        
        /*on récupère tous les params*/
        $params = $this->request->getParams();
        
        /*
        case
        /cours => ajoute une nouvelle ressource
        */
        if (!$params){
            //var_dump($_POST);
            $this->csrf->verifyToken();
            
            $this->sanitizer->filter();

            $res = $this->db->callProcedure('InsererStatut', $_POST);
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Statut enseignant ajouté'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de l\'ajout d\'un statut enseignant'));                        
            }                 
            $this->request->redirect('/referentiels/statuts?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {

            $this->csrf->verifyToken();
            
            $this->sanitizer->filter();

            $res = $this->db->callProcedure('ModifierStatut', $_POST);
            
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Statut enseignant modifié'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la modification du statut enseignant'));                        
            }
            $this->request->redirect('/referentiels/statuts?action=show');
        }
    }
}
?>