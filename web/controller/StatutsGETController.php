

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class StatutsGETController extends Controller {
    
    public function render($args=null){
   
        $this->namespace = 'Statuts Enseignant';
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
                    $this->title = 'Tous les Statuts Enseignant';
                    
                    $this->data = $this->db->findAll('VueListeStatut');
                    $titleButton = array(array('icon' => 'add', 'action' => '/web/referentiels/statuts?action=add', 'enabled'=> $this->isUserAdmin()),
                                         array('icon' => 'add', 'action' => '/web/referentiels/statuts?action=download', 'enabled'=> $this->isUserAdmin()));
                    
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
                    $this->title = 'Modification du statut enseignant n°'.$params['id'];

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
                    
                    $this->data = $this->db->findOne('Statut', $params['id']);                    
    
                    include('view2/forms.php');
                    
                    break;

                case "delete":
                    
                    $res = $this->db->callProcedure("SupprimerStatut", array("idStatut" => $params['id']));
                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Statut enseignant supprimé'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la suppression du statut'));                        
                    }
                    $this->redirect('/referentiels/statuts?action=show');
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