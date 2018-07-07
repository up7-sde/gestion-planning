<?php

include_once('Controller.php');

/*
 * Effectue la déconnexion
 */
class AuthGETController extends Controller {
    public function render($args=null){
        
        $this->namespace = 'Auth';
        $this->title = 'Authentification';
        $this->pageType = 'Auth';

        /*on recupère l'action process ou quit*/
        $params = $this->request->getExtraParams();
        
        /*/auth?action=process*/
        if (isset($params) && isset($params['action']) && !!$params['action'] && $params['action'] === 'process'){
            include('view2/auth.php'); // debug
        
        /*/auth?action=quit*/
        } elseif (isset($params) && isset($params['action']) && !!$params['action'] && $params['action'] === 'quit') {
            $this->auth->logout();
            $this->request->redirect('/auth?action=process');
        
        /*not found*/
        } else {
            throw new Exception('404');
        }
    }
}
?>