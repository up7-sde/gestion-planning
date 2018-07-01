<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class RoutinesPOSTController extends Controller {
    public function render($args=null){
        
        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
        
        $res = $this->db->callProcedure('DuppliquerService', $_POST);

        if ($res) {
            $this->messenger->push(array('status'=>'success', 'message'=>'Success_Services copiés'));
            
        } else {
            $this->messenger->push(array('status'=>'fail', 'message'=>'Fail_Echec de la procédure'));                        
        }

        $this->redirect('/');
    }
}
?>