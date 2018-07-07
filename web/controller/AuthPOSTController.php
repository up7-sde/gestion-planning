<?php
include_once('Controller.php');

/*
 * Effectue le login et redirige en fonction du résultat
 */
class AuthPostController extends Controller  {

    public function render($args=null){

        /*vérifie si c'est bien le bon token*/
        $this->csrf->verifyToken();
        
        /*filtre les posts avant requête en base*/
        $this->sanitizer->filter(); 
    
        if ($this->auth->login()){
            $user = $this->auth->getUserInfos();
            $this->messenger->push(array('status'=>'success', 'message'=>'Content de vous revoir '. $user['name'] . '!'));
            $to = '/';
        } else {
            $this->messenger->push(array('status'=>'fail', 'message'=>'Login ou mot de passe invalide'));
            $to = '/auth?action=process';
        }
        $this->request->redirect($to);
    }
}

?>