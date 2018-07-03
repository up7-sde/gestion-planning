<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class UtilisateursPOSTController extends Controller {
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

            if(isset($_POST['mdp'])) $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            if(isset($_POST['mdp2'])) unset($_POST['mdp2']);
            
            $res = $this->db->callProcedure('InsererUtilisateur', $_POST);

            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Utilisateur ajouté'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de l\'ajout d\'un utilisateur'));                        
            }                 
            $this->redirect('/utilisateurs?action=show');
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