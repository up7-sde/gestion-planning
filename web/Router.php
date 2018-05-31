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
            $this->setRoutes();
            $GLOBALS["DEBUG"] .= "construct router > "; // debug
        }

        /*
         * Ajouter chaque route contenu dans le fichier routes.xml
         */
        private function setRoutes()
        {
            // Importer le fichier dans un tableau
            $routes_xml = file_get_contents("routes.xml");
            $routes = simplexml_load_string($routes_xml);
            // var_dump($routes);
            // Ajouter chaque route
            foreach ($routes as $r) {
                $controller = (string) $r->controller;
                $path = (string) $r->path;
                $method = (string) $r->method;
                // debug : voir comment on pourrait factoriser pour GET/POST (variabilisé plutot que if/else)
                if ($method == "GET")
                {
                    // echo "<br>ADD GET ROUTE :"; var_dump($r);
                    // echo "<br>route method  : " . $method. "</br>"; // debug
                    // echo "route path  : " . $path . "</br>"; // debug
                    // echo "route controller  : " . $controller . "</br>"; // debug
                    $this->onGET($controller, $path, function($controller, $args=null) {
                        // Appeler la bonne classe de controlleur dans args[0]
                        // echo "controller dans le callable : $controller";
                        require('controller/'.$controller.'.php');
                        $c = new $controller();
                        $c->render($args);
                    });
                }
                elseif ($method == "POST")
                {
                    // echo "<br>ADD POST ROUTE :"; var_dump($r);
                    // echo "<br>route method  : " . $method. "</br>"; // debug
                    // echo "route path  : " . $path . "</br>"; // debug
                    // echo "route controller  : " . $controller . "</br>"; // debug
                    $this->onPOST($controller, $path, function($controller, $args=null) {
                        // Appeler la bonne classe de controlleur dans args[0]
                        // echo "controller dans le callable : $controller";
                        require('controller/'.$controller.'.php');
                        $c = new $controller();
                        $c->render($args);
                    });
                }
            }
        }


        public function onGET($controller, $path, $callable){
            $route = new Route($path, $callable, $controller);
            $this->routes["GET"][] = $route;
            return $route; // On retourne la route pour "enchainer" les méthodes
        }

        public function onPOST($controller, $path, $callable){
            $route = new Route($path, $callable,  $controller);
            $this->routes["POST"][] = $route;
            return $route; // On retourne la route pour "enchainer" les méthodes
        }

        public function listen(){
            if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
                throw new RouterException('REQUEST_METHOD does not exist');
            }

            foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){ //pour chaque item de la méthode demandée
                if($route->match($this->url)){ //si ça match
                    $_SESSION['history'][] = '/'.$this->url;
                    return $route->call(); //on call un render
                }
            }
            throw new NotFoundException('Not Found');
        }
    }
