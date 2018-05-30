<?php
include_once('Controller.php');

/*
 * Effectue le login et redirige en fonction du résultat
 */
class LoginPostController extends Controller  {

    public function render($args=null){
        $pageTitle = 'SDE | Login';
        if ($this->auth->login()){
            $to = $this->getReferrer();
        } else {
            $to = '/auth/login';
        }
        $this->redirect($to);
    }
}

?>
