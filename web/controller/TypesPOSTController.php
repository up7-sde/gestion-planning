<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class TypesPOSTController extends Controller {
    public function render($args=null){

        /*verifier auth*/
        $user = $this->auth->getUserInfos();
        if (!$user || !$this->auth->isUserAdmin()) $this->request->force('401');

        /*on récupère tous les params*/
        $params = $this->request->getParams();

        /*
        case
        /cours => ajoute une nouvelle ressource
        */
        if (!$params){
            
            $this->csrf->verifyToken();

            $this->sanitizer->filter();

            $res = $this->db->callProcedure('InsererTypeService', $_POST);
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Type de service ajouté'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));                        
            }
            $this->request->redirect('/referentiels/types?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {
            
            $this->csrf->verifyToken();
            
            $this->sanitizer->filter();            
            
            $res = $this->db->callProcedure('ModifierTypeService', $_POST);


            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Type de service modifié'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la modification du type de service'));
            }
            $this->request->redirect('/referentiels/types?action=show');
        }
    }
}
?>