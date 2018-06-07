<?php

/*todo*/
//revoir db
//fusionner route et router
//revoir completement organisation des controlleurs avec bonnes methodes
//refactor errors => integrer dans app
//passer au webdesign vmnt

$GLOBALS["DEBUG"] = "START DEBUG >";

if (!isset($_SESSION)) session_start();
/*les exceptions*/
require('exceptions.php');

/*le router*/
require('Router.php');
$router = new Router();

/* le controller de base */
require('controller/Controller.php');

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
