<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class CoursGETController extends Controller {
    
    public function render($args=null){
   
        
        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth?action=process');
        
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
                   
                    $this->title = 'Tous les Cours';
                    $this->data = $this->db->findAll('VueListeService');
                    
                    $titleButton = array('icon' => 'add', 'action' => '/web/cours?action=add');
                    $tableAction = '/web/cours';
                    //var_dump($_SESSION['message']);
                    include('view2/tables.php');
                    break;

                case "add":
                   
                    $this->title = "Nouveau Cours";
                    $titleButton = null;
                    
                    $this->data = null;
                    
                    $formInputs = array('idEnseignant' =>  $this->db->findAll('VueLabelEnseignant'), 
                                        'idTypeService' => $this->db->findAll('VueLabelTypeService'), 
                                        'annee' => null, 
                                        'apogee' => $this->db->findAll('VueLabelEnseignement'),
                                        'nbHeures' => null);
                    
                    $formActions = array('form' => '/web/cours', 'back' => '/web/cours?action=show'); 
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
            $this->pageName = 'Cours n°'.$params['id'];

            switch ($extraParams['action']) {
                
                case "edit":
                    
                    $this->title = 'Modification du Cours n°'.$params['id'];

                    $titleButton = array('icon' => 'delete', 'action' => '/web/cours/'.$params['id'].'?action=delete');
                    //(IN p_idService INT, IN p_idEnseignant INT, IN p_idTypeService INT, IN p_annee INT, IN p_apogee VARCHAR(45), IN p_nbHeures INT)
                    $formInputs = array('idEnseignant' =>  $this->db->findAll('VueLabelEnseignant'), 
                                        'idTypeService' => $this->db->findAll('VueLabelTypeService'), 
                                        'annee' => null,
                                        'apogee' => $this->db->findAll('VueLabelEnseignement'), 
                                        'nbHeures' => null);
                    
                    $hiddenInput = 'idService';

                    $formActions = array('form' => '/web/cours/'.$params['id'], 'back' => '/web/cours/?action=show'); 
                    
                    $this->data = $this->db->findOne('Service', $params['id']);                    
    
                    include('view2/forms.php');
                    
                    break;

                case "delete":
                    $id = $params['id'];
                    $res = $this->db->callProcedure("SupprimerService", array("idService" => $params['id']));
                    
                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Success_Cours n°'.$params['id'].' supprimé'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Fail_Echec de la suppression'));                        
                    }

                    $this->redirect('/cours?action=show');
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