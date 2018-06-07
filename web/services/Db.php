<?php

//chaque fonction de sa classe est traduiite en une string qui sert à query la db
include_once('model/Model.php');

class Db{

    private $connection = null;
    private $host = "localhost";
    private $user;
    private $password;
    private $dbname;
    private $attributes;
    private $query;

    public function __construct(){
        $this->attributes = Model::$attributes;
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

        $this->dbname = getenv('BDD_NOM');

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
                $this->connection = new PDO("mysql:host=$this->host; dbname=$this->dbname", $this->user, $this->password, array(PDO::ATTR_PERSISTENT => TRUE));
                // set the PDO error mode to exception
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->exec('SET CHARACTER SET utf8');

            } catch(PDOException $e){
                //créer des classes erreurs ppersonnalisées pour redirect ou 404 si il faut suivant les cas
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    /*
     * Obtenir les vues par leur nom
     */
    public function findAll($entity){
      $this->connect();
      $res = $this->connection->query("SELECT * FROM " . $entity);
      return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
     * Obtenir un enregistrement d'un item (Formation, enseignant, etc.)
     */
     public function findOne($entity, $id)
     {
       $this->connect();
       $res = $this->connection->query("SELECT * FROM $entity WHERE id$entity = " . $id);
       $data = $res->fetchAll(PDO::FETCH_ASSOC);
       // debug : vérifier le retour de la requête avant de poursuivre (id valide...)
       return $data;
    }

    public function callProcedure($name, $args){
        $this->connect();
        
        //tout se joue sur la pos des args!!!
        $sql = "CALL $name(";        
        
        foreach($args as $key => $value){
          $sql = $sql.':'.$key.',';
        }
        $sql = trim($sql, ',');
        $sql = $sql.')';
        
        $statement = $this->connection->prepare($sql);

        foreach($args as $key => $value){
          foreach($this->attributes as $attribute){
            if($attribute['name'] === $key){
              $param = ':'.$key;
              $statement->bindParam($param, $args[$key], $attribute['type']);
            }
          }
        }
        return $statement->execute();
    }

    public function kill(){
        $this->connection = null;
    }
}
?>
