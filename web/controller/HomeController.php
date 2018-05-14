<?php

include_once('Controller.php');
include_once('view/components/Header.php');
include_once('view/components/Menu.php');
include_once('view/components/BreadCrumbs.php');
include_once('view/components/Table.php');

//class Home extends Controller
class HomeController extends Controller {

    private $db;
    private $passport;

    public function __construct($db, $passport){
        $this->passport = $passport;
        $this->db = $db;
    }

    public function render(){

        // Debug : temporaire j'instanci un db ici pour faciliter le dev (utiliser le service bdd par la suite)
        try
        {
            $bdd = new PDO("mysql:host=localhost;dbname=sde", "admin", "mdpadmin");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
        $reponse = $bdd->query("CALL SelectionnerEnseignements()");
        $tab = $reponse->fetchAll(PDO::FETCH_ASSOC);

        $user = $this->passport->getUser();
        !$user ? $title = 'Home | Visitor' :  $title = 'Home | '.$user['name'];

        // appelle la vu correspondante (pour l'instant la vue de base, à modifier)
        require('view/HomeView.php');
    }
}
