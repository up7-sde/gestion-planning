<?php

include_once('Controller.php');

/*
 * Supprimer un service et rediriger vers la liste des services avec un message
 */
class ServiceSupprimerController extends Controller {
    public function render($args=null){
        $id = $args[0];
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
        $res = $this->db->supprimerService($id);
        $_SESSION["message"] = $res ? "Service $id supprimé " : "Echec de la suppression du service : $id";
        $this->redirect('/service');
    }
}
