<?php

//chaque fonction de sa classe est traduiite en une string qui sert à query la db

class Db {

    private $connection = null;
    private $host = "localhost";
    private $user;
    private $password;
    private $dbname;

    public function __construct(){
        // Voir si on passe des paramètre au constructeur...
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
                $this->connection = new PDO("mysql:host=$this->host; dbname=$this->dbname", $this->user, $this->password);
                // set the PDO error mode to exception
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->exec('SET CHARACTER SET utf8');

            } catch(PDOException $e){
                //créer des classes erreurs ppersonnalisées pour redirect ou 404 si il faut suivant les cas
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    public function query($action = null, $args = null){
        //var_dump($this->connection);
        $GLOBALS["DEBUG"] .= "avant connexion !";
        $this->connect();
        //SelectionnerEnseignements
        $res = $this->connection->query("CALL $action();");
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    /*
     * Obtenir les vues par leur nom
     */
    public function getVueByName($nom_vue)
    {
      $this->connect();
      $res = $this->connection->query("SELECT * FROM " . $nom_vue);
      $data = $res->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }

    public function getAllEnseignant()
    {
      return $this->getVueByName("VueListeEnseignant");
    }
    public function getAllEnseignement()
    {
      return $this->getVueByName("VueListeEnseignement");
    }
    public function getAllFormation()
    {
      return $this->getVueByName("VueListeFormation");
    }
    public function getAllService()
    {
      return $this->getVueByName("VueListeService");
    }
    public function getLabelEnseignant()
    {
      return $this->getVueByName("VueLabelEnseignant");
    }
    public function getLabelEnseignement()
    {
      return $this->getVueByName("VueLabelEnseignement");
    }
    public function getLabelFormation()
    {
      return $this->getVueByName("VueLabelFormation");
    }
    public function getLabelTypeService()
    {
      return $this->getVueByName("VueLabelTypeService");
    }
    public function getLabelStatut()
    {
      return $this->getVueByName("VueLabelStatut");
    }
    public function getLabelDiplome()
    {
      return $this->getVueByName("VueLabelDiplome");
    }

    /*
     * Obtenir un enregistrement d'un item (Formation, enseignant, etc.)
     */
     public function getService($id)
     {
       $this->connect();
       $res = $this->connection->query("SELECT * FROM Service WHERE idService = " . $id);
       $data = $res->fetchAll(PDO::FETCH_ASSOC);
       // debug : vérifier le retour de la requête avant de poursuivre (id valide...)
       return $data;
     }

    public function modifierService($args)
    {
      $this->connect();
      $sth = $this->connection->prepare("CALL ModifierService(:idService, :idEnseignant, :idTypeService, :annee, :apogee, :nbHeures)");
      $sth->bindParam(':idService', $args["idService"], PDO::PARAM_INT);
      $sth->bindParam(':idEnseignant', $args["idEnseignant"], PDO::PARAM_INT);
      $sth->bindParam(':idTypeService', $args["idTypeService"], PDO::PARAM_INT);
      $sth->bindParam(':annee', $args["annee"], PDO::PARAM_INT);
      $sth->bindParam(':apogee', $args["apogee"], PDO::PARAM_STR);
      $sth->bindParam(':nbHeures', $args["nbHeures"], PDO::PARAM_INT);
      $res = $sth->execute();
      return $res;
    }

    public function ajouterService($args)
    {
      $this->connect();
      $sth = $this->connection->prepare("CALL InsererService(:idEnseignant, :idTypeService, :annee, :apogee, :nbHeures)");
      $sth->bindParam(':idEnseignant', $args["idEnseignant"], PDO::PARAM_INT);
      $sth->bindParam(':idTypeService', $args["idTypeService"], PDO::PARAM_INT);
      $sth->bindParam(':annee', $args["annee"], PDO::PARAM_INT);
      $sth->bindParam(':apogee', $args["apogee"], PDO::PARAM_STR);
      $sth->bindParam(':nbHeures', $args["nbHeures"], PDO::PARAM_INT);
      $res = $sth->execute();
      return $res;
    }

    public function kill(){
        $this->connection = null;
    }
}
?>
