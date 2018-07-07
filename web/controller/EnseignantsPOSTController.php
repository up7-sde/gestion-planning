<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class EnseignantsPOSTController extends Controller {
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
            $this->csrf->verifyToken();
            
            $this->sanitizer->filter(); 

            $res = $this->db->callProcedure('InsererEnseignant', $_POST);

            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Enseignant ajouté'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));
            }
            //$_SESSION["message"] = $res;
            $this->request->redirect('/enseignants?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {
            $this->csrf->verifyToken();
            
            $this->sanitizer->filter(); 

            $res = $this->db->callProcedure('ModifierEnseignant', $_POST);
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Enseignant modifié'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));                        
            }
            $this->request->redirect('/enseignants?action=show');
        }
    }
}
?>
