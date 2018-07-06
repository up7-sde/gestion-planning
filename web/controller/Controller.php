<?php

include_once('services/Db.php');
include_once('services/Auth.php');
include_once('services/Messenger.php');
include_once('view2/ViewEngine.php');
include_once('services/FileMaker.php');
include_once('services/Sanitizer.php');
include_once('services/CSRF.php');
include_once('services/Request.php');

class Controller {

    protected $namespace;
    protected $title;
    protected $pageType;
    protected $data;

    protected $request;
    protected $db;
    protected $auth;
    protected $messenger;
    protected $viewEngine;
    protected $fileMaker;
    protected $sanitizer;
    protected $csrf;
    
    public function __construct(){
        /*args de la db ici? => non*/
        $this->request = new Request();
        $this->db = new Db();
        $this->messenger = new Messenger();
        $this->sanitizer = new Sanitizer();
        $this->auth = new Auth($this->db);
        $this->viewEngine = new ViewEngine();
        $this->fileMaker = new FileMaker();
        $this->csrf = new CSRF();    
    }

    // Prends une liste d'arguments $args
    public function render($args=null){
        echo 'Hello world!';
    }

    /*mettre dans auth*/
    public function isUserAuthenticated(){
        return isset($_SESSION) && isset($_SESSION['passport']);
    }

    public function isUserAdmin(){
        return isset($_SESSION) && isset($_SESSION['passport']) && $_SESSION['passport']['level'] === 1;
    }

    public function getUserInfos(){
        if (isset($_SESSION) && isset($_SESSION['passport'])){
            return $_SESSION['passport'];
        }
        return FALSE;
    }

    public function getParams(){
        if (isset($_SESSION) && isset($_SESSION['params']) && count($_SESSION['params']) > 0 ){
            return $_SESSION['params'];
        }
        return FALSE;
    }

    public function getExtraParams(){
        if (isset($_SESSION) && isset($_SESSION['extraParams']) && count($_SESSION['extraParams']) > 0){
            return $_SESSION['extraParams'];
        }
        return FALSE;
    }

    public function redirect($path = '/home'){
        header("Location: http://localhost/web$path", TRUE);
        die();
    }

    public function getReferrer(){

        for ($i = count($_SESSION["history"])-1; $i>=0; $i--){
            if (!preg_match('/auth/', $_SESSION["history"][$i])){
                return $_SESSION["history"][$i];
            }
        }
        return '/';
    }

    public function getWholeHistory(){
        return $_SESSION["history"];
    }

    public function getCurrentUrl(){
        return $_SESSION["history"][count($_SESSION["history"])-1];
    }

    public function getLastUrl(){
        return isset($_SESSION["history"][count($_SESSION["history"])-2])?
            $_SESSION["history"][count($_SESSION["history"])-2] : '/';
    }

    public function getLastDifferentURL(){
        
        for ($i = count($_SESSION["history"])-1; $i>=0; $i--){
            if ($_SESSION["history"][$i]!==$this->getCurrentUrl()){
            return $_SESSION["history"][$i];
            }
        }
        return '/';
    }

    public function force($status){
        
        switch($status){
        
            case '400': 
                $title = '400 Bad request';
                $message = 'Votre requête est malformée... Que voulez vous faire?';
                break;
            
            case '401': 
                $title = '401 Unauthorized';
                $message = 'Vous n\'avez pas les droits nécessaires pour soumettre cette requête...';
                break;
            
            case '404':
            
                $title = '404 Not Found';
                $message = 'Ouch... L\'URL demandée n\'existe pas!';
                break;
            
            case '500': default:
                $title = '500 Internal Server Error';
                $message = 'Une erreur est survenue, veuillez nous en excuser.';
                break;
        }
        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $title, TRUE, intval($status));
        include('view2/error.php');
        die();
    }
}

?>