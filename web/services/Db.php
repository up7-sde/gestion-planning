<?php

//extends la classe de Rémy
//chaque fonction de sa classe est traduiite en une string qui sert à query la db

class Db {

    private $connection;
    private $server;
    private $user;
    private $password;
    private $schema;

    //voir si on passe en arg les params... plusieurs connections?
    //bref c'est possible
    public function __construct(){

        $this->connection = null;
        $this->server = "localhost";
    }

    private function connectionExists(){
        //check if exists
        return $this->connection != null;
    }

    private function getAuthLevel(){
        //check if exists
        if (isset($_SESSION) && isset($_SESSION["passport"])){
            //echo "Auth ok<br/>";
            return $_SESSION["passport"]["level"];
        }
        throw new Exception('problem with session');
    }

    public function connect(){

        $this->schema = getenv('BDD_NOM');

        if ($this->getAuthLevel() === 1){
            $this->user = getenv('ADMIN_MYSQL_LOGIN');
            $this->password = getenv('ADMIN_MYSQL_PASSWD');

        } else {
            $this->user = getenv('ENSEIGNANT_MYSQL_LOGIN');
            $this->password = getenv('ENSEIGNANT_MYSQL_PASSWD');

        }

        // Obtenir la liste des cours en fonction de l'année passé en parametre dans l'url

        if (!$this->connectionExists()){

            try {
                
                $this->connection = new PDO("mysql:host=$this->server; dbname=$this->schema", $this->user, $this->password);
                // set the PDO error mode to exception
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->exec('SET CHARACTER SET utf8');
                
                //echo "Connected successfully<br/>";

                /*$bdd = new PDO("mysql:host=localhost;dbname=sde", "admin", getenv('ADMIN_MYSQL_PASSWD'));
                $bdd->exec('SET CHARACTER SET utf8');
                    
                $tab = $reponse->fetchAll(PDO::FETCH_ASSOC); */
            } catch(PDOException $e){

                //créer des classes erreurs ppersonnalisées pour redirect ou 404 si il faut suivant les cas
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    public function query($action = null, $args = null){

        //var_dump($this->connection);
        $this->connect();
        //SelectionnerEnseignements
        $res = $this->connection->query("CALL $action()");     
        $data = $res->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function kill(){
        $this->connection = null;
    }
}
?>
