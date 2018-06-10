<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class EnseignantsPOSTController extends Controller {
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
            $res = $this->db->callProcedure('InsererEnseignant', $_POST);
            //$_SESSION["message"] = $res;                    
            $this->redirect('/enseignants?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {
            
            $res = $this->db->callProcedure('ModifierEnseignant', $_POST);
            /*$this->db->modifierService($_POST);
            $_SESSION["message"] = $res;*/
            $this->redirect('/enseignants?action=show');
        }
    }
}
?>