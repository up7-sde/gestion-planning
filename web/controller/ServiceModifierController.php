<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class ServiceModifierController extends Controller {

    public function render($args=null){
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
        $res = $this->db->modifierService($_POST);
        $_SESSION["message"] = $res ? "Service bien modifié" : "Modification impossible";
        $this->redirect('/service');
    }
}
