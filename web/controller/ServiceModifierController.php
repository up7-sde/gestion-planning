<?php

include_once('Controller.php');

//class Home extends Controller
class ServiceModifierController extends Controller {

    public function render($args=null){
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
        $title = "Service"; // debug
        $pageTitle = "Service | " . $user['name'];
        // Faire la modification en base et générer un message
        $res = $this->db->modifierService($_POST);
        // Ajouter un message
        $_SESSION["message"] = $res ? "Modifié" : "Modification impossible";
        // renvoyer vers le formulaire de modification
        $this->redirect('/service/' . $_POST["idService"]);
    }
}
