<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class StatutsPOSTController extends Controller {
    public function render($args=null){
        
        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
        
        /*on récupère tous les params*/
        $params = $this->getParams();
        
        /*
        case
        /cours => ajoute une nouvelle ressource
        */
        if (!$params){
            var_dump($_POST);
            $res = $this->db->callProcedure('InsererStatut', $_POST);
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Statut enseignant ajouté'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de l\'ajout d\'un statut enseignant'));                        
            }                 
            $this->redirect('/referentiels/statuts?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {

            $res = $this->db->callProcedure('ModifierService', $_POST);
            
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Cours modifié'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));                        
            }
            $this->redirect('/cours?action=show');
        }
    }
}
?>