<?php

class Request {

    public function getUserInfos(){
        if (isset($_SESSION) && isset($_SESSION['passport'])){
            return $_SESSION['passport'];
        }
        return FALSE;
    }
    
    /*public function getParams(){
        if (isset($_SESSION) && isset($_SESSION['params'])){
            return $_SESSION['params'];
        }
        return FALSE;
    }*/

    public function redirect($to = '/home'){
        header("Location: http://localhost/web$to");
        die();
    }

    public function getReferrer(){
        
        //refactor avec regex !!!!!!!!! /auth/*
        for ($i = count($_SESSION["history"])-1; $i>=0; $i--){
            if ($_SESSION["history"][$i] !== '/auth/login' && $_SESSION["history"][$i] !== '/auth/logout')
            return $_SESSION["history"][$i];
        }
        return '/';
    }

    public function getWholeHistory(){
        return $_SESSION["history"];
    }

    public function getCurrentUrl(){
        return $_SESSION["history"][count($_SESSION["history"])-1];
    }
}
?>