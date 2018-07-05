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
    
    (new Controller())->force($e->getMessage());   
}

?>