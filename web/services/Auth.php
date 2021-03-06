<?php

class Auth {

    //private $sessionStore;
    private $db;

    public function __construct($db){
        //$this->sessionStore = $sessionStore;
        $this->db = $db;
    }


    public function login(){

    
    $user = $this->db->findOneUser($_POST['email']);
        
    /*var_dump(password_hash("123azerty", PASSWORD_BCRYPT));
    die();*/
        //voir en base de données si il y a correspondance
        //requete attendue => une requette qui renvoie -1 ou la pk de la table 
        if (count($user) > 0 && password_verify($_POST['password'], $user[0]['mdp'])) {
            
            //explicits
            //mettre la clé de la table users dans les sessions => serialize
            //c'est tout le delire de passport
            $_SESSION["passport"]["id"] = $user[0]["idUtilisateur"];
            $_SESSION["passport"]["name"] = $user[0]["nom"];
            $_SESSION["passport"]["email"] = $user[0]["email"];
            $_SESSION["passport"]["level"] = intval($user[0]["authLevel"]);
            $_SESSION["passport"]["color"] = $user[0]["headerColor"];
            
            //on met la pk de l'user en db dans les var de session pour pouvoir les retrouver facilement
            //var_dump($this->router->getRefferer());
            return TRUE;
        }
        return FALSE;
    }

    public function logout(){
        if (isset($_SESSION)) session_destroy();
    }

    public function refreshCredentials($data){
        
        $_SESSION["passport"]["id"] = $data["idUtilisateur"];
        $_SESSION["passport"]["name"] = $data["login"];
        $_SESSION["passport"]["email"] = $data["email"];
        $_SESSION["passport"]["level"] = $_SESSION["passport"]["level"];
        $_SESSION["passport"]["color"] = $data["headerColor"];
    }
    /**sign in sign out*/

    public function isUserAuthenticated(){
        return isset($_SESSION) && isset($_SESSION['passport']);
    }

    public function isUserAdmin(){
        return isset($_SESSION) && isset($_SESSION['passport']) && $_SESSION['passport']['level'] === 1;
    }

    public function getUserInfos(){
        if (isset($_SESSION) && isset($_SESSION['passport'])){
            return $_SESSION['passport'];
        }
        return FALSE;
    }
}

?>