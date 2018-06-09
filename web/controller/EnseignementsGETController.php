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
                    $this->pageName = 'Nouveau Cours';
                    $this->title = "Nouveau Cours";
                    $titleButton = null;
                    
                    $this->data = null;
                    
                    $formInputs = array('apogee' => $this->db->findAll('VueLabelEnseignement'), 
                                        'idEnseignant' =>  $this->db->findAll('VueLabelEnseignant'), 
                                        'idTypeService' => $this->db->findAll('VueLabelTypeService'), 
                                        'annee' => null, 
                                        'nbHeures' => null);
                    
                    $formActions = array('form' => '/web/cours', 'back' => '/web/cours?action=show'); 

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
                    
                    $this->pageName = 'Modification du Cours n°'.$params['id'];
                    $this->title = 'Modification du Cours n°'.$params['id'];

                    $titleButton = array('icon' => 'delete', 'action' => '/web/cours/'.$params['id'].'?action=delete');

                    $formInputs = array('idService' => null,
                                        'apogee' => $this->db->findAll('VueLabelEnseignement'), 
                                        'idEnseignant' =>  $this->db->findAll('VueLabelEnseignant'), 
                                        'idTypeService' => $this->db->findAll('VueLabelTypeService'), 
                                        'annee' => null, 
                                        'nbHeures' => null);
                    
                    $formActions = array('form' => '/web/cours/'.$params['id'], 'back' => '/web/cours/'.$params['id'].'?action=show'); 
                    
                    $this->data = $this->db->findOne('Service', $params['id']);                    
    
                    include('view2/forms.php');
                    
                    break;

                case "delete":
                    $id = $params['id'];
                    $res = $this->db->callProcedure("SupprimerService", array("idService" => $params['id']));
                    $_SESSION["message"] = $res;
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