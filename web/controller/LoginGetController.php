<?php

include_once('Controller.php');

/*
 * Affiche le login
 */
class LoginGetController extends Controller {

    public function render($args=null){
        $pageTitle = 'SDE | Login';
        return include('view/LoginView.php'); // debug
    }
}

?>
