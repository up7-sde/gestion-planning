

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class TypesGETController extends Controller {
    
    public function render($args=null){
   
        $this->namespace = 'Types de cours';
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
                    $this->pageType = 'Table';
                    $this->title = 'Tous les Types de Cours';
                    
                    $this->data = $this->db->findAll('VueListeType');
                    $titleButton = array(array('icon' => 'add', 'action' => '/web/referentiels/types?action=add', 'enabled'=> $this->isUserAdmin()),
                                        array('icon' => 'download', 'action' => '/web/referentiels/diplomes?action=download', 'enabled'=> $this->isUserAdmin()));
                    $tableAction = '/web/referentiels/types';
                    
                    include('view2/tables.php');
                    break;

                case "add":
                    $this->pageType = 'New';
                    
                    $this->title = 'Nouveau type de cours';
                    $titleButton = null;
                    
                    $this->data = null;

                    //(IN p_nom VARCHAR(45), IN p_idDiplome INT)
                    $formInputs = array('intitule' => null,
                                        'poids' => null);
                    
                    $formActions = array('form' => '/web/referentiels/types', 'back' => '/web/referentiels/types?action=show'); 
                    $hiddenInput = null;
                    
                    include('view2/forms.php');
                    break;
                
                case "download":
                    $data = $this->data = $this->db->findAll('VueListeType');
                    $this->fileMaker->passToBrowser($data);
                    break;
                
                default:
                    throw new Exception('404');
                    break;
            }
        /*
        case
        /cours/:id?action=(show|edit|delete)
        */
        } elseif (!!$params && !!$extraParams && isset($extraParams['action'])) { 
            

            switch ($extraParams['action']) {
                
                case "edit":
                    
                    $this->pageType = 'Edit';
                    $this->title = 'Modification du type de service n°'.$params['id'];

                    $formInputs = array('intitule' => null,
                                        'poids' => null
                                    );

                    $formActions = array('form' => '/web/referentiels/types/'.$params['id'],
                                        'back' => '/web/referentiels/types?action=show',
                                        'delete' => '/web/referentiels/types/'.$params['id'].'?action=delete');
                    
                    $hiddenInput = 'idTypeService';
                    
                    $this->data = $this->db->findOne('TypeService', $params['id']);                    
    
                    include('view2/forms.php');
                    
                    break;

                case "delete":
                    //var_dump($params['id']);

                    $res = $this->db->callProcedure("SupprimerTypeService", array("idTypeService" => $params['id']));
                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Type de cours supprimé'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));                        
                    }
                    
                    $this->redirect('/referentiels/types?action=show');
                    break;
                
                default:
                    throw new Exception('404');
                    break;
            }
        } else {
            throw new Exception('404');
        }
    }
}
?>