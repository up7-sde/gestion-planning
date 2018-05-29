<?php

if (!isset($_SESSION)) session_start();
/*les exceptions*/
require('exceptions.php');

/*le router*/
require('Router.php');
$router = new Router();

/* Les controlleurs */
require('controller/EnseignantController.php');
require('controller/LoginGetController.php');
require('controller/LoginPostController.php');
require('controller/LogoutController.php');
require('controller/EnseignementController.php');
require('controller/FormationController.php');
require('controller/ServiceGetController.php');
require('controller/ServicePostController.php');
require('controller/HomeController.php');

/* Associer les routes au routeur */
$router->onGET('/auth/login', function(){
    (new LoginGetController())->render();
});

$router->onPOST('/auth/login', function(){
    (new LoginPostController())->render();
});

$router->onPOST('/auth/logout', function(){
    (new LogoutController())->render();
});


$router->onGET('/enseignant/', function(){
    (new EnseignantController())->render();
});

$router->onGET('/enseignement/', function(){
    (new EnseignementController())->render();
});

$router->onGET('/formation/', function(){
    (new FormationController())->render();
});

$router->onGET('/service/', function(){
    (new ServiceGetController())->render();
});

$router->onPOST('/modifier/service', function(){
  (new ServicePostController())->render();
});
$router->onPOST('/ajouter/service', function(){
  (new ServiceGetController())->render();
});

$router->onGET('/service/:id', function($id){
    (new ServiceGetController())->render($id);
});

$router->onGET('/', function(){
   (new controller())->redirect('/home');
});

$router->onGET('/home', function() {
    (new HomeController())->render();
});

try {
    //on essaye d'executer le callback associé à la route
    $router->listen();

//pas de redirect! on veut un code 401 pas un code redirect!
//on redir vers login que quand on logout sans erreur

} catch (NotFoundException $e) { // Si la route n'existe pas
    (new Controller)->force404();

} catch (PassportException $e) {
    (new Controller)->redirect('/auth/login');

} catch (RouterException $e) {
    (new Controller)->force400();

} catch (PDOException $e) {
    (new Controller)->force400();
}

?>
