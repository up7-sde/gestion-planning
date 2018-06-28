<?php

class Auth {

    //private $sessionStore;
    private $db;

    public function __construct($db, $messenger){
        //$this->sessionStore = $sessionStore;7
        $this->db = $db;
        $this->messenger = $messenger;
    }

    /*!!!!!!!*/
    //pb requete en base à chaque get user => c php vaut mieux les mettre dans session
    /*créer classe strategy*/

    //a voir
    public function login(){

        // Looks for a user by name
        $user = $this->db->getUser(strtoupper($_POST["name"]));

        // Creates a passport if user exists and passwd is valid
        if ($user)
        {
            if (password_verify($_POST["password"], $user["mdp"]))
            {
                $_SESSION["passport"]["id"] = $user["id"];
                $_SESSION["passport"]["name"] = $user["nom"];
                $_SESSION["passport"]["email"] = $user["email"];
                $_SESSION["passport"]["level"] = intval($user["authLevel"]);
                $_SESSION["passport"]["color"] = $user["bckColor"];
                    $this->messenger->push(array('status'=>'success', 'message'=>"Content de vous retrouvez " . $user["nom"]));
                return TRUE;
            }
            else {
                    $this->messenger->push(array('status'=>'fail', 'message'=>'Mot de passe invalide...'));
            }
        }
        else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Login invalide...'));
        }
        return FALSE;
    }

    public function logout(){
        if (isset($_SESSION)) session_destroy();
    }

    /**sign in sign out*/
}

?>
