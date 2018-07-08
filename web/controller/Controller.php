<?php

/*les services*/
include_once('services/Db.php');
include_once('services/Auth.php');
include_once('services/Messenger.php');
include_once('services/FileMaker.php');
include_once('services/Sanitizer.php');
include_once('services/CSRF.php');
include_once('services/Request.php');

/*les composants de la vue*/
include_once('view2/ViewEngine.php');

class Controller {

    /*variables*/
    protected $namespace;
    protected $title;
    protected $pageType;
    protected $data;

    /*objets*/
    protected $request;
    protected $db;
    protected $auth;
    protected $messenger;
    protected $viewEngine;
    protected $fileMaker;
    protected $sanitizer;
    protected $csrf;
    
    public function __construct(){
        
        /*classes*/
        $this->request = new Request();
        $this->db = new Db();
        $this->messenger = new Messenger();
        $this->sanitizer = new Sanitizer();
        $this->auth = new Auth($this->db);
        $this->fileMaker = new FileMaker();
        $this->csrf = new CSRF();    

        /*pour la vue*/
        $this->viewEngine = new ViewEngine();
        
    }

    //fonction unique à appeler quand route mach
    //comme un main
    //on y met la logique de l'application
    //on y utilise les services créés dans le constructeur
    public function render($args=null){
        echo 'Hello world!';
    }
}

?>