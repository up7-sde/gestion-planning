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
<<<<<<< HEAD
        
    $user = $this->db->findOneUser($_POST["email"]);
        
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
=======
>>>>>>> 6b4863e7ad97bd3a635093945f2a5e1369b35200

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
