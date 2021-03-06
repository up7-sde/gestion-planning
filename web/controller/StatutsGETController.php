

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class StatutsGETController extends Controller {
    
    public function render($args=null){
   
        $this->namespace = 'Statuts enseignant';
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
                    $this->title = 'Tous les statuts enseignant';
                    
                    $this->data = $this->db->findAll('VueListeStatut');
                    $titleButton = array(array('icon' => 'add', 'action' => '/web/referentiels/statuts?action=add', 'enabled'=> $this->auth->isUserAdmin()),
                                         array('icon' => 'download', 'action' => '/web/referentiels/statuts?action=download', 'enabled'=> $this->auth->isUserAdmin()));
                    
                    $tableAction = '/web/referentiels/statuts';
                    //var_dump($_SESSION['message']);
                    include('view2/tables.php');
                    break;

                case "add":
                    $this->pageType = 'New';
                    $this->title = 'Nouveau statut enseignant';
                    $titleButton = null;
                    
                    $this->data = null;

                    $formInputs = array('intitule' => null, 
                                        'heureService' => null,
                                        'titulaire' => array(array('id' => 1, 'nom' => 'OUI'), array('id' => 0, 'nom' => 'NON')));
                    
                    $formActions = array('form' => '/web/referentiels/statuts', 'back' => '/web/referentiels/statuts?action=show'); 
                    $hiddenInput = null;
                    
                    include('view2/forms.php');
                    break;
                
                case "download":
                    $data = $this->data = $this->db->findAll('VueListeStatut');
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
                    $this->title = 'Statut enseignant n°'.$params['id'];

                    $this->data = $this->db->findOne('Statut', $params['id']);                    
                    if (!$this->data) $this->request->force('404');

                    $prevNext = $this->db->findPreviousNext($params['id'], 'Statut');
                    
                    $titleButton = array(array('icon' => 'previous', 
                                                'action' => $prevNext['prev']? '/web/referentiels/statuts/'. $prevNext['prev'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['prev']? TRUE : FALSE),
                                         array('icon' => 'next', 
                                                'action' => $prevNext['next']? '/web/referentiels/statuts/'. $prevNext['next'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['next']? TRUE : FALSE)
                                            );

                    $formInputs = array('intitule' => null, 
                                        'heureService' => null,
                                        'titulaire' => array(
                                                            array('id' => 1, 'nom' => 'OUI'), 
                                                            array('id' => 0, 'nom' => 'NON')
                                                            )
                                                        );

                    $formActions = array('form' => '/web/referentiels/statuts/'.$params['id'],
                                        'back' => '/web/referentiels/statuts?action=show',
                                        'delete' => '/web/referentiels/statuts/'.$params['id'].'?action=delete');

                    $hiddenInput = 'idStatut';
                    
                    include('view2/forms.php');
                    
                    break;

                case "delete":
                    
                    $res = $this->db->callProcedure("SupprimerStatut", array("idStatut" => $params['id']));
                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Statut enseignant supprimé'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la suppression du statut'));                        
                    }
                    $this->request->redirect('/referentiels/statuts?action=show');
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