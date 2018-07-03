<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class EnseignementsPOSTController extends Controller {
    public function render($args=null){

        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');

        /*on récupère tous les params*/
        $params = $this->getParams();

        /*
        case
        /cours => ajoute une nouvelle ressource
        */
        if (!$params){

            $res = $this->db->callProcedure('InsererEnseignement', $_POST);
            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Enseignement ajouté'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));                        
            }
            $this->redirect('/enseignements?action=show');
        /*
        case
        /cours/:id => modifie la ressource :id
        */
        } else {
            //var_dump($_POST);

            $res = $this->db->callProcedure('ModifierEnseignement', array("id"=>"54EEE2EC",
                                                                            "apogee2"=> "54EEE2EC" ,
                                                                            "intitule"=>"THÉORIE DE LA MONN." ,
                                                                            "hCM"=> "0",
                                                                             "hTP"=> "72" ,
                                                                            "semestre"=>"4" ,
                                                                            "nbGroupes"=> "4",
                                                                            "idFormation"=> "2" ));

            if ($res) {
                $this->messenger->push(array('status'=>'success', 'message'=>'Enseignement modifié'));
            } else {
                $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));
            }

            $this->redirect('/enseignements?action=show');
        }
    }
}
?>
