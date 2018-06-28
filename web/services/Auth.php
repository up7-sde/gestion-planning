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

        // Debug , pour l'instant on doit configurer l'env pour que le service db fonctionne
        $_SESSION["passport"]["level"] = 1;

        // Trouver l'utilistateur par son nom
        $user = $this->db->findOne('Utilisateur', strtoupper($_POST["name"]), "nom", true);

        // Debug, nettoyer les modifs apportées pour le serivce db
        unset($_SESSION["passport"]["level"]);
        $this->db->kill();


        echo "USER : <br>";
        var_dump($user);

        // Si on a un user avec ce nom et que le mdp et correspond au hash on remplit le passport
        if (!empty($user))
        {
            $hash = $user[0]["mdp"];
            if (password_verify($_POST["password"], $hash))
            {
                $_SESSION["passport"]["id"] = $user[0]["id"];
                $_SESSION["passport"]["name"] =  $user[0]["nom"];
                $_SESSION["passport"]["email"] =  $user[0]["email"];
                $_SESSION["passport"]["level"] =  intval($user[0]["authLevel"]);
                $_SESSION["passport"]["color"] =  $user[0]["bckColor"];
                //     $this->messenger->push(array('status'=>'success', 'message'=>'Heureux de vous revoir'));
                return TRUE;
            }
            else {
                //     $this->messenger->push(array('status'=>'fail', 'message'=>'Mot de passe invalide...'));
            }
        }
        else {
            //     $this->messenger->push(array('status'=>'fail', 'message'=>'Login invalide...'));
        }
        return FALSE;
    }

    public function logout(){
        if (isset($_SESSION)) session_destroy();
    }

    /**sign in sign out*/
}

?>
