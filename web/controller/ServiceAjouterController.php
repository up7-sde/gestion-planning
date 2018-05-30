<?php

include_once('Controller.php');

// Permet d'ajouter un service
class ServiceAjouterController extends Controller {

    public function render($args=null){
        $user = $this->getUserInfos();
        var_dump($user);
        if (!$user) $this->redirect('/auth/login');
        $title = "Nouveau service";
        $pageTitle = "Nouveau Service | " . $user['name'];
        // Extraire les labels pour le formulaire
        $labelEnseignant = $this->db->getLabelEnseignant();
        $labelEnseignement = $this->db->getLabelEnseignement();
        $labelTypeService = $this->db->getLabelTypeService();
        include('view/FormService.php');

        // $title = "Service"; // debug
        // $pageTitle = "Service | " . $user['name'];
        // // Faire la modification en base et générer un message
        // $res = $this->db->modifierService($_POST);
        // // Ajouter un message
        // $_SESSION["message"] = $res ? "Modifié" : "Modification impossible";
        // // renvoyer vers le formulaire de modification
        // $this->redirect('/service/' . $_POST["idService"]);
    }
}
