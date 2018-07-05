<?php
include_once('Controller.php');

/*
 * Effectue le login et redirige en fonction du résultat
 */
class AuthPostController extends Controller  {

    public function render($args=null){

        if(!$this->csrf->verifyToken()) throw new NotFoundException();
        
        $this->sanitizer->filter(); 
    
        if ($this->auth->login()){
            $user = $this->getUserInfos();
            $this->messenger->push(array('status'=>'success', 'message'=>'Content de vous revoir '. $user['name'] . '!'));
            $to = '/';
        } else {
            $this->messenger->push(array('status'=>'fail', 'message'=>'Identifiants invalides'));
            $to = '/auth?action=process';
        }
        $this->redirect($to);
    }
}

?>
