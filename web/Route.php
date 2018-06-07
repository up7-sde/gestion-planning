<?php

class Route {

        private $path;
        private $callable;
        private $controller;
        private $matches = [];
        private $params = [];

        public function __construct($path, $callable){
            $this->path = trim($path, '/');
            // On retire les / inutils
            $this->callable = $callable;
        }

        //on doit stocker les params
        public function match($url){
            
            $url = trim($url, '/');
            $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
            $regex = "#^$path$#i";

            if(!preg_match($regex, $url, $matches)){
                return false;
            }

            array_shift($matches);

            $this->matches = $matches;
            //$_SESSION['params'] = $this->matches;
            
            $this->storeParams();
            $this->storeExtraParams();
            // On sauvegarde les paramètre dans la session
            
            return true;
        }

        private function storeParams(){
            /*on recupere les cles*/    
            preg_match_all("#:([\w]+)#", $this->path, $keys);
            array_shift($keys);
            $keys = $keys[0];
            
            /*on purge*/
            if (isset($_SESSION['params'])) $_SESSION['params'] = [];
            
            /*on met les nouveaux*/
            for($i=0;$i<count($this->matches);$i++){
                $_SESSION['params'][$keys[$i]] = $this->matches[$i];
            }
            //var_dump($_SESSION['params']);
        }

        private function storeExtraParams(){
            /*on purge*/
            if (isset($_SESSION['extraParams'])) $_SESSION['extraParams'] = [];
            
            /*on met les nouveaux*/
            $extraParams = $_GET;
            array_shift($extraParams);
            $_SESSION['extraParams'] = $extraParams;
        }
        
        public function call(){
            return call_user_func($this->callable);
        }
    }
?>
