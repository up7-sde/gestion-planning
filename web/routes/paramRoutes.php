<?php
/*route pour l'app*/
/*type de route hidden => seul un visireur authentifié peut s'y rendre*/
//si pas authentifié, redir vers login sans rien montrer

require('controller/ParamController.php');

$router->onGET('/param', function() use ($passport, $router) {
    (new ParamController($passport, $router))->render();
});

$router->onGET('/param/:id', function($id) use ($passport, $router) {
    (new ParamController($passport, $router))->render($id);
});

?>