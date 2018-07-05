<?php
/*le router*/
require('Router.php');

$GLOBALS["DEBUG"] = "START DEBUG >";

if (!isset($_SESSION)) session_start();

try {
    //on essaye d'executer le callback associé à la route
    (new Router())->listen();

//pas de redirect! on veut un code 401 pas un code redirect!
//on redir vers login que quand on logout sans erreur

} catch (Exception $e) {

    switch($e->getMessage()){
        case '400': 
            (new Controller())->force400();
            break;
        case '401': 
            (new Controller())->force401();
            break;
        case '404':
            (new Controller())->force404();
            break;
        case '500': default:
            (new Controller())->force500();
            break;
    }
}

?>