<?php

//extends la classe de Rémy
//chaque fonction de sa classe est traduiite en une string qui sert à query la db

class Database {

    private $connection;
    private $servername;
    private $username;
    private $password;
    private $dbname;

    //voir si on passe en arg les params... plusieurs connections?
    //bref c'est possible
    public function __construct($servername,  $username, $password, $dbname){

        $this->connection = null;
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
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
        return 0;
    }

    public function connect(){

        var_dump($this->getAuthLevel());

        $bdd = getenv('BDD_NOM');

        if ($this->getAuthLevel() === 1){
            $user = getenv('ADMIN_MYSQL_LOGIN');
            $password = getenv('ADMIN_MYSQL_PASSWD');
            var_dump($password);
            var_dump($user);
            var_dump($bdd);

        } else {
            $user = getenv('ENSEIGNANT_MYSQL_LOGIN');
            $password = getenv('ENSEIGNANT_MYSQL_PASSWD');

        }

        // Obtenir la liste des cours en fonction de l'année passé en parametre dans l'url

        if (!$this->connectionExists()){

            try {
                
                $this->connection = new PDO("mysql:host=localhost; dbname=$bdd", $user, $password);
                // set the PDO error mode to exception
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully<br/>";

                /*$bdd = new PDO("mysql:host=localhost;dbname=sde", "admin", getenv('ADMIN_MYSQL_PASSWD'));
                $bdd->exec('SET CHARACTER SET utf8');
                $reponse = $bdd->query("CALL SelectionnerEnseignements()");     
                $tab = $reponse->fetchAll(PDO::FETCH_ASSOC); */
            } catch(PDOException $e){

                //créer des classes erreurs ppersonnalisées pour redirect ou 404 si il faut suivant les cas
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    public function query($action = null){

        //var_dump($this->connection);
        $this->connect();

        // $res = $this->connection->prepare('CALL SelectionnerCours(?)');
        //
        // $data = $res->fetchAll();
        //
        // var_dump($data);

        //var_dump($this->connection);

        //$donnees = $res->fetchAll(PDO::FETCH_ASSOC);

        // appel de la procédure stockée


        //connect if not exists, pas besoin de se connecter manuellement, juste query
        //ça connecte automatiquement si tu fais query
        //ce serait magnifique si tu pouvais intégrer ton code dedans
        //je pense qu'un héritage serait cool
        //en mode Model extends db ou l'inverse avec model qui est ta classe
        // un systeme ou action c'est genre une string ou autre
        //et tu fais un genre de switch ici
        // ou de reconnaissance par le nom avec une concatenation
        //je verrais bien deux methodes query
        //une qui retourne => selectQuery
        //et une qui retourne pas =>et une qui retourne pas => insertQuery
        //autre chose, j'aurais besoin de requettes pour l'auth
        //mais je veux bien que t'attendes pour les faire parce que ya un sujet d'encryption et tout faut qu'on en discute
    }

    public function kill(){
        $this->connection = null;
    }
}
?>
