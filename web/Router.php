<?php

require('Route.php');

/*
 * Représente le routeur. Contient les différentes routes.
 * Recoit les requêtes et fait le lien avec la bonne route
 */
class Router {

        private $url; // Contiendra l'URL sur laquelle on souhaite se rendre
        private $routes = []; // Contiendra la liste des routes

        public function __construct(){
            $this->url = $_GET['url'];
            $this->loadRoutes();
            $GLOBALS["DEBUG"] .= "construct router > "; // debug
        }

        /*
         * Ajouter chaque route contenu dans le fichier routes.xml
         */
        private function loadRoutes()
        {
            // Importer le fichier dans un tableau
            $routes = simplexml_load_string(file_get_contents("routes.xml"));

            //ajouter les redirects
            foreach ($routes->redirect as $redirect){
                $from = (string) $redirect->from;
                $to = (string) $redirect->to;

                $route = new Route($from, function() use($to) {
                    (new Controller())->redirect($to);
                });
                //ne redirect que les gets
                $this->routes['GET'][] = $route;
            }

            // Ajouter chaque route
            foreach ($routes->route as $item) {
                $controllerName = (string) $item->controller;
                $path = (string) $item->path;
                $method = (string) $item->method;
                $route = new Route($path, function() use($controllerName) {
                    require('controller/'.$controllerName.'.php');
                    (new $controllerName())->render();
                });

                $this->routes[$method][] = $route;
            }
        }

        private function storeHistory(){

            $query = "";

            if (count($_GET)>1){
                $params = $_GET;
                array_shift($params);
                $query = '?'. http_build_query($params);
            }

            $_SESSION['history'][] = '/'.$this->url . $query;
        }

        /*enlever les callbacks pour stocker les routes en session*/
        public function listen(){
            if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
                throw new RouterException('REQUEST_METHOD does not exist');
            }

            foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){ //pour chaque item de la méthode demandée
                if($route->match($this->url)){ //si ça match
                    $this->storeHistory();
                    return $route->call(); //on call un render
                }
            }
            throw new NotFoundException('Not Found');
        }
    }
