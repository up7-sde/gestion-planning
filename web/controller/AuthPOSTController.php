<?php
include_once('Controller.php');

/*
 * Effectue le login et redirige en fonction du résultat
 */
class AuthPostController extends Controller  {

    public function render($args=null){

        if ($this->auth->login()){
            $user = $this->getUserInfos();
            $this->messenger->push(array('status'=>'success', 'message'=>'Connection OK_Bienvenue '. $user['name'] . '!'));            
            $to = '/';
        } else {
            $this->messenger->push(array('status'=>'fail', 'message'=>'Fail_Email ou mot de passe invalide'));                                    
            $to = '/auth?action=process';
        }

        $this->redirect($to);
    }
}

?>
