<?php

class Route {

        private $path;
        private $callable;
        private $controller;
        private $matches = [];
        private $params = [];

        public function __construct($path, $callable, $controller){
            $this->path = trim($path, '/');  // On retire les / inutils
            $this->callable = $callable;
            $this->controller = $controller;
        }

        /**
        * Permettra de capturer l'url avec les paramètre
        * get('/posts/:slug-:id') par exemple
        **/
        public function match($url){
            $url = trim($url, '/');
            $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
            $regex = "#^$path$#i";
            if(!preg_match($regex, $url, $matches)){
                return false;
            }
            array_shift($matches);

            $this->matches = $matches;
            //$_SESSION['params'] = $matches;              // On sauvegarde les paramètre dans l'instance pour plus tard
            return true;
        }

        /*
         * Va appeler le callback fourni au moment de l'ajout de la route dans le routeur
         * Avec les arguments suivant :
         * Le controlleur à importer
         * Une liste des arguments (contenu dans l'url et traité par this->match())
         */
        public function call(){
            return call_user_func_array($this->callable, array($this->controller, $this->matches));
        }
    }
?>
