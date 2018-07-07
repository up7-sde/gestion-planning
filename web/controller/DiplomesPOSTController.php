<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class DiplomesPOSTController extends Controller {
    public function render($args=null){

        /*verifier auth*/
        $user = $this->auth->getUserInfos();
        if (!$user || !$this->auth->isUserAdmin()) throw new Exception('401');

        /*on récupère tous les params*/
        $params = $this->request->getParams();

        /*
        case
        /cours => ajoute une nouvelle ressource
        */
        if (!$params){
            
            /*var_dump($this->sanitizer->filter($_POST));
            die();*/
            $this->csrf->verifyToken();
            
            $this->sanitizer->filter(); 

            $res = $this->db->callProcedure('InsererDiplome', $_POST);
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Diplôme ajouté.'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));
            }
            $this->request->redirect('/referentiels/diplomes?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {

            $this->csrf->verifyToken();
            
            $this->sanitizer->filter(); 

            $res = $this->db->callProcedure('ModifierDiplome', $_POST);

            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Diplôme modifié'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));
            }
            $this->request->redirect('/referentiels/diplomes?action=show');
        }
    }
}
?>
