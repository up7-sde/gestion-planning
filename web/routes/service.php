<?php

/* Les controlleurs */
require('controller/ServiceListeController.php');
require('controller/ServiceAfficherController.php');
require('controller/ServiceModifierController.php');
require('controller/ServiceAjouterController.php');

/* Associer les routes au routeur */
$router->onGET('/service/', function(){
    (new ServiceListeController())->render();
});

$router->onGET('/service/nouveau', function(){
  (new ServiceAfficherController())->render();
});

$router->onGET('/service/:id', function($id){
    (new ServiceAfficherController())->render($id);
});
$router->onPOST('/ajouter/service/', function(){
  (new ServiceAjouterController())->render();
});
$router->onPOST('/modifier/service/:id', function($id){
  (new ServiceModifierController())->render($id);
});

?>
