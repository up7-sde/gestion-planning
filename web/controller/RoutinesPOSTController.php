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

        if (preg_match('/nvelle/', $this->request->getCurrentUrl())){
            $res = $this->db->callProcedure('DuppliquerService', $_POST); 
            $success= 'Services copiés';
            $fail = 'Impossible de copier les services';           

        } else {
            $res = $this->db->callProcedure('SupprimerAnnee', $_POST); 
            $success = 'Services supprimés';
            $fail = 'Impossible de supprimer les services'; 
        }
        
        if ($res) {
            $this->messenger->push(array('status'=>'success', 'message'=>$success));

        } else {
            $this->messenger->push(array('status'=>'fail', 'message'=>$fail));                        
        }

        $this->request->redirect('/cours?action=show');
    }
}
?>
