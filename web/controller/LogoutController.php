<?php

include_once('Controller.php');

class LogoutController extends Controller {

    public function render($args=null){
        $this->auth->logout();
        $this->redirect('/auth/login');
    }
}

?>
