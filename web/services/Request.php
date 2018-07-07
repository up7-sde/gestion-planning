<?php
class Request{

    public static function getParams(){
        if (isset($_SESSION) && isset($_SESSION['params']) && count($_SESSION['params']) > 0 ){
            return $_SESSION['params'];
        }
        return FALSE;
    }

    public static function getExtraParams(){
        if (isset($_SESSION) && isset($_SESSION['extraParams']) && count($_SESSION['extraParams']) > 0){
            return $_SESSION['extraParams'];
        }
        return FALSE;
    }

    public static function redirect($path = '/home'){
        header("Location: http://localhost/web$path", TRUE);
        die();
    }

    public static function getReferrer(){

        for ($i = count($_SESSION["history"])-1; $i>=0; $i--){
            if (!preg_match('/auth/', $_SESSION["history"][$i])){
                return $_SESSION["history"][$i];
            }
        }
        return '/';
    }

    public static function getWholeHistory(){
        return $_SESSION["history"];
    }

    public static function getCurrentUrl(){
        return $_SESSION["history"][count($_SESSION["history"])-1];
    }

    public static function getLastUrl(){
        return isset($_SESSION["history"][count($_SESSION["history"])-2])?
            $_SESSION["history"][count($_SESSION["history"])-2] : '/';
    }

    public static function getLastDifferentURL(){
        
        for ($i = count($_SESSION["history"])-1; $i>=0; $i--){
            if ($_SESSION["history"][$i]!==$_SESSION["history"][count($_SESSION["history"])-1]){
            return $_SESSION["history"][$i];
            }
        }
        return '/';
    }

    public static function force($status){
        
        switch($status){
        
            case '400': 
                $title = '400 Bad request';
                $message = 'Votre requête est malformée... Que voulez vous faire?';
                break;
            
            case '401': 
                $title = '401 Unauthorized';
                $message = 'Vous n\'avez pas les droits nécessaires pour soumettre cette requête...';
                break;
            
            case '404':
            
                $title = '404 Not Found';
                $message = 'Ouch... L\'URL demandée n\'existe pas!';
                break;
            
            case '500': default:
                $title = '500 Internal Server Error';
                $message = 'Une erreur est survenue, veuillez nous en excuser.';
                break;
        }
        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $title, TRUE, intval($status) or 500);
        include('view2/error.php');
        die();
    }
}
?>