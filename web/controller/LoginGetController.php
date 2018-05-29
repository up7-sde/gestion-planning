<?php

include_once('Controller.php');

class LoginGetController extends Controller {

    public function render($args=null){

        $pageTitle = 'SDE | Login';
        return include('view/LoginView.php'); // debug
    }
}

?>
