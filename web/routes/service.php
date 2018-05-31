<?php

/* Les controlleurs */

/* Associer les routes au routeur */
$router->onGET('/service/', function(){
    require('controller/ServiceListeController.php');
    (new ServiceListeController())->render();
});

$router->onGET('/service/nouveau', function(){
    require('controller/ServiceAfficherController.php');
  (new ServiceAfficherController())->render();
});

$router->onGET('/service/:id', function($id){
    require('controller/ServiceAfficherController.php');
    (new ServiceAfficherController())->render($id);
});
$router->onPOST('/ajouter/service/', function(){
    require('controller/ServiceAjouterController.php');
  (new ServiceAjouterController())->render();
});
$router->onPOST('/modifier/service/:id', function($id){
    require('controller/ServiceModifierController.php');
  (new ServiceModifierController())->render($id);
});

$router->onGET('/supprimer/service/:id', function($id){
    require('controller/ServiceSupprimerController.php');
    (new ServiceSupprimerController())->render($id);
});

?>
