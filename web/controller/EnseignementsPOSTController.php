<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class EnseignementsPOSTController extends Controller {
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
            $res = $this->db->callProcedure('InsererEnseignement', $_POST);
            //$_SESSION["message"] = $res;                    
            $this->redirect('/enseignements?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {
            
            $res = $this->db->callProcedure('ModifierEnseignement', $_POST);
            /*$this->db->modifierService($_POST);
            $_SESSION["message"] = $res;*/
            $this->redirect('/enseignements?action=show');
        }
    }
}
?>