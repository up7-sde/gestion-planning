<?php 
include_once('Controller.php');
class LogoutController extends Controller {
   
    private $passport;
    private $router;

    public function __construct($passport, $router){
        $this->passport = $passport;
        $this->router = $router;
    } 
    
    public function render(){
        $this->passport->logout();
        $this->router->redirect('/home');
    }
}

?>