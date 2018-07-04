<?php

include_once('services/Db.php');
include_once('services/Auth.php');
include_once('services/Messenger.php');
include_once('view2/ViewEngine.php');
include_once('services/FileMaker.php');
include_once('services/Sanitizer.php');
include_once('services/CSRF.php');

class Controller {

    protected $namespace;
    protected $title;
    protected $pageType;
    protected $data;

    protected $db;
    protected $auth;
    protected $messenger;
    protected $viewEngine;
    protected $fileMaker;
    protected $sanitizer;
    protected $csrf;
    
    public function __construct(){
        /*args de la db ici? => non*/
        $this->db = new Db();
        $this->messenger = new Messenger();
        $this->sanitizer = new Sanitizer();
        $this->auth = new Auth($this->db, $this->sanitizer);
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
        header("Location: http://localhost/web$path");
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

    public function force400(){
        header("HTTP/1.1 400 Bad request");
        die();
    }

    public function force401(){
        header("HTTP/1.1 401 Unauthorized");
        die();
    }

    public function force403(){
        /*$this->title = '403 | Forbidden';
        $this->content = '<h1>403 Forbidden</h1>';
        $this->style = '<link href="/web/static/css/style.css" rel="stylesheet"/>';
        $this->script = null;

        include('view/template.php');*/
        header('HTTP/1.1 403 Forbidden');
        die();
    }

    public function force404(){
        header('HTTP/1.1 404 Not Found');
        include('view2/notFound.php');
        die();
    }
}

?>