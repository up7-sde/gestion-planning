<?php
include_once('Controller.php');

/*
 * Effectue le login et redirige en fonction du résultat
 */
class AuthPostController extends Controller  {

    public function render($args=null){
        $pageTitle = 'SDE | Login';

        if ($this->auth->login()){
            $to = '/';
        } else {
            $to = '/auth?action=process';
        }

        $this->redirect($to);
    }
}

?>
