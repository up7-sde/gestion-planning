<?php

include_once('Controller.php');

/*
 * Effectue la déconnexion
 */
class AuthGETController extends Controller {
    public function render($args=null){

        $this->namespace = 'Auth';

        /*on recupère l'action process ou quit*/
        $params = $this->getExtraParams();

        /*/auth?action=process*/
        if (isset($params) && isset($params['action']) && !!$params['action'] && $params['action'] === 'process'){
            $pageTitle = 'SDE | Login';
            include('view2/auth.php'); // debug
        /*/auth?action=quit*/
        } elseif (isset($params) && isset($params['action']) && !!$params['action'] && $params['action'] === 'quit') {
            $this->auth->logout();
            $this->redirect('/auth?action=process');

        /*not found*/
        } else {
            throw new NotFoundException('Not found');
        }
    }
}

?>
