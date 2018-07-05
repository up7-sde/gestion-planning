<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class ProfilPOSTController extends Controller {
    public function render($args=null){
        
        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
        
            /*on hash le mot de passe*/
            if(!$this->csrf->verifyToken()) throw new NotFoundException();
            
            $this->sanitizer->filter();
            
            if(isset($_POST['mdp'])) $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            /*on enleve la confirmation*/
            if(isset($_POST['mdp2'])) unset($_POST['mdp2']);
            
            /*var_dump($_POST);
            die();*/ 
            
            $res = $this->db->callProcedure('ModifierUtilisateur', $_POST);

            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Profil modifié'));
                /*pour rafraishir les credentials*/
                $this->auth->refreshCredentials($_POST);
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la modification du profil'));                        
            }

            $this->redirect('/');
    }
}
?>