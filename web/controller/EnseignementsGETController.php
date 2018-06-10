<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class EnseignementsGETController extends Controller {
    
    public function render($args=null){
   
        
        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
        
        /*on récupère tous les types de params*/
        $params = $this->getParams();
        $extraParams = $this->getExtraParams();
        
        /*
        case
        /cours?action=(show|add)
        */
        if (!$params && !!$extraParams && isset($extraParams['action'])){ 
            //echo "no prams!!";

            switch ($extraParams['action']) {
                case "show":
                    // Get sans argument : vue de la liste
                    $this->title = 'Tous les Enseignements';
                    $this->data = $this->db->findAll('VueListeEnseignement');
                    
                    $titleButton = array('icon' => 'add', 'action' => '/web/enseignements?action=add');
                    $tableAction = '/web/enseignements';
                    //var_dump($_SESSION['message']);
                    include('view2/tables.php');
                    break;

                case "add":
                    $this->pageName = 'Nouvel Enseignement';
                    $this->title = 'Nouvel Enseignement';
                    $titleButton = null;
                    
                    $this->data = null;
                    
                    //(IN p_apogee VARCHAR(45), IN p_intitule VARCHAR(45), IN p_heureCM INT, IN p_heureTP 0000000INT, IN p_semestre INT, IN p_nbGroupes INT, IN p_idFormation INT)
                    $formInputs = array('apogee' => $this->db->findAll('VueLabelEnseignement'), 
                                        'intitule' => null, 
                                        'hCM' => null, 
                                        'hTP' => null, 
                                        'semestre' => null,
                                        'nbGroupes' => null,
                                        'idFormation' => $this->db->findAll('VueLabelFormation'));
                    
                    $formActions = array('form' => '/web/enseignements', 'back' => '/web/enseignements?action=show'); 
                    $hiddenInput = null;
                    
                    include('view2/forms.php');
                    break;
                
                default:
                    throw new NotFoundException('Not Found');
                    break;
            }
        /*
        case
        /cours/:id?action=(show|edit|delete)
        */
        } elseif (!!$params && !!$extraParams && isset($extraParams['action'])) { 
            
            switch ($extraParams['action']) {
                
                case "edit":
                    
                    $this->title = 'Modification de l\'Enseignement #'.$params['id'];

                    $titleButton = array('icon' => 'delete', 'action' => '/web/enseignements/'.$params['id'].'?action=delete');

                    $formInputs = array('apogee2' => null, 
                                        'intitule' => null, 
                                        'hCM' => null, 
                                        'hTP' => null, 
                                        'semestre' => null,
                                        'nbGroupes' => null,
                                        'idFormation' => $this->db->findAll('VueLabelFormation'));
                    
                    $formActions = array('form' => '/web/enseignements/'.$params['id'], 'back' => '/web/enseignements?action=show'); 
                    $hiddenInput = 'id';
                    
                    $this->data = $this->db->findOne('VueListeEnseignement', $params['id'], 'apogee2', TRUE);                    
    
                    include('view2/forms.php');
                    
                    break;

                case "delete":
                    $id = $params['id'];
                    $res = $this->db->callProcedure("SupprimerEnseignement", array("apogee" => $params['id']));
                    
                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Success_Enseignement n°'.$params['id'].' supprimé'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Fail_Echec de la suppression'));                        
                    }

                    $this->redirect('/enseignements?action=show');
                    break;
                
                default:
                    throw new NotFoundException('Not Found');
                    break;
            }
        } else {
            throw new NotFoundException('Not Found');
        }
    }
}
?>