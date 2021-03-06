

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class TypesGETController extends Controller {
    
    public function render($args=null){
   
        $this->namespace = 'Types de cours';
        /*verifier auth*/
        $user = $this->auth->getUserInfos();
        if (!$user) $this->request->redirect('/auth?action=process');
        
        /*on récupère tous les types de params*/
        $params = $this->request->getParams();
        $extraParams = $this->request->getExtraParams();
        
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
                    $this->title = 'Tous les types de cours';
                    
                    $this->data = $this->db->findAll('VueListeType');
                    $titleButton = array(array('icon' => 'add', 'action' => '/web/referentiels/types?action=add', 'enabled'=> $this->auth->isUserAdmin()),
                                        array('icon' => 'download', 'action' => '/web/referentiels/diplomes?action=download', 'enabled'=> $this->auth->isUserAdmin()));
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
                $this->request->force('404');
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
                    $this->title = 'Type de cours n°'.$params['id'];
                    
                    $this->data = $this->db->findOne('TypeService', $params['id']);                    
                    if (!$this->data) throw new Exception('404');

                    $prevNext = $this->db->findPreviousNext($params['id'], 'TypeService');
                    
                    $titleButton = array(array('icon' => 'previous', 
                                                'action' => $prevNext['prev']? '/web/referentiels/types/'. $prevNext['prev'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['prev']? TRUE : FALSE),
                                         array('icon' => 'next', 
                                                'action' => $prevNext['next']? '/web/referentiels/types/'. $prevNext['next'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['next']? TRUE : FALSE)
                                            );

                    $formInputs = array('intitule' => null,
                                        'poids' => null
                                    );

                    $formActions = array('form' => '/web/referentiels/types/'.$params['id'],
                                        'back' => '/web/referentiels/types?action=show',
                                        'delete' => '/web/referentiels/types/'.$params['id'].'?action=delete');
                    
                    $hiddenInput = 'idTypeService';
                    
                    
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
                    
                    $this->request->redirect('/referentiels/types?action=show');
                    break;
                
                default:
                    $this->request->force('404');
                    break;
            }
        } else {
            $this->request->force('404');
        }
    }
}
?>