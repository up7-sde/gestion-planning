<?php

include_once('Controller.php');

/*
 * Ajouter un nouveau service et rediriger vers la liste des services avec un message
 */
class ServiceAjouterController extends Controller {

    public function render($args=null){
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
        $res = $this->db->ajouterService($_POST);
        $_SESSION["message"] = $res ? "Service ajouté " : "Impossible d'ajouter ce service";
        $this->redirect('/service');
    }
}
