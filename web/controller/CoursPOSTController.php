<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class CoursPOSTController extends Controller {
    public function render($args=null){

        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user || !$this->isUserAdmin()) $this->redirect('/auth/login');

        /*on récupère tous les params*/
        $params = $this->getParams();

        /*
        case
        /cours => ajoute une nouvelle ressource
        */
        if (!$params){
            /*var_dump($_POST);
            die();*/
            $this->csrf->verifyToken();
            
            $this->sanitizer->filter(); 

            $res = $this->db->callProcedure('InsererService', $_POST);
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Le cours à été ajouté.'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));
            }
            $this->redirect('/cours?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {

            $this->csrf->verifyToken();
            
            $this->sanitizer->filter(); 

            $res = $this->db->callProcedure('ModifierService', $_POST);

            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Le cours a été modifié'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));
            }
            $this->redirect('/cours?action=show');
        }
    }
}
?>
