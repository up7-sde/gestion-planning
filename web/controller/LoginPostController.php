<?php 
include_once('Controller.php');
class LoginPostController extends Controller  {
   
    private $passport;
    private $router;

    public function __construct($passport, $router){
        $this->passport = $passport;
        $this->router = $router;
    } 
    
    public function render(){
        if ($this->passport->login()){
            $this->router->redirect($this->router->getReferer());
        }
        throw new PassportException();
    }
}

?>