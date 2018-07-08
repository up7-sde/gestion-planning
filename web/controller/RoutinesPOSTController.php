<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class RoutinesPOSTController extends Controller {
    public function render($args=null){

        /*verifier auth*/
        $user = $this->auth->getUserInfos();
        if (!$user || !$this->auth->isUserAdmin()) $this->request->force('401');

        $this->csrf->verifyToken();
        
        $this->sanitizer->filter();

        $res = $this->db->callProcedure('DuppliquerService', $_POST);

        if ($res) {
            $this->messenger->push(array('status'=>'success', 'message'=>'Services copiés'));

        } else {
            $this->messenger->push(array('status'=>'fail', 'message'=>'Impossible de copier les services'));                        
        }

        $this->request->redirect('/cours?action=show');
    }
}
?>
