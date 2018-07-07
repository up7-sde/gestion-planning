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
}

?>