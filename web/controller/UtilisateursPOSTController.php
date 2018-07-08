<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class UtilisateursPOSTController extends Controller {
    public function render($args=null){
        
        /*verifier auth*/
        $user = $this->auth->getUserInfos();
        if (!$user || !$this->auth->isUserAdmin()) $this->request->force('401');
        
        /*on récupère tous les params*/
        $params = $this->request->getParams();
        
        if (!$params){
            
            $this->csrf->verifyToken();
            
            $this->sanitizer->filter();

            if(isset($_POST['mdp'])) $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            if(isset($_POST['mdp2'])) unset($_POST['mdp2']);
            
            $res = $this->db->callProcedure('InsererUtilisateur', $_POST);

            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Utilisateur ajouté'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de l\'ajout d\'un utilisateur'));                        
            }                 
            $this->request->redirect('/utilisateurs?action=show');
        
        }
    }
}
?>