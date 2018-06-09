<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class CoursPOSTController extends Controller {
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
            $res = $this->db->callProcedure('InsererService', $_POST);
            //$_SESSION["message"] = $res;                    
            $this->redirect('/cours?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {
            var_dump('sdsd');
            $res = $this->db->callProcedure('ModifierService', $_POST);
            /*$this->db->modifierService($_POST);
            $_SESSION["message"] = $res;*/
            $this->redirect('/cours?action=show');
        }
    }
}
?>