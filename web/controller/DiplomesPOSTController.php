<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class DiplomesPOSTController extends Controller {
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
        if (!$params && $this->isUserAdmin()){
            /*var_dump($_POST);
            die();*/
            $res = $this->db->callProcedure('InsererDiplome', $_POST);
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Diplôme ajouté.'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));
            }
            $this->redirect('/referentiels/diplomes?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {

            $res = $this->db->callProcedure('ModifierDiplome', $_POST);

            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Diplôme modifié'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));
            }
            $this->redirect('/referentiels/diplomes?action=show');
        }
    }
}
?>
