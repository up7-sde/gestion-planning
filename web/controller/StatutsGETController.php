

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
                    $this->title = 'Tous les Statuts Enseignant';
                    
                    $this->data = $this->db->findAll('VueListeStatut');
                    $titleButton = array(array('icon' => 'add', 'action' => '/web/referentiels/statuts?action=add'),
                                         array('icon' => 'add', 'action' => '/web/referentiels/statuts?action=download'));
                    
                    $tableAction = '/web/referentiels/statuts';
                    //var_dump($_SESSION['message']);
                    include('view2/tables.php');
                    break;

                case "add":
                    $this->pageName = 'Nouveau statut enseignant';
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
                    
                //(IN p_idFormation INT, IN p_nom VARCHAR(45), IN p_idDiplome INT)
                    $this->title = 'Modification de la formation n°'.$params['id'];

                    $titleButton = array('icon' => 'delete', 'action' => '/web/cours/'.$params['id'].'?action=delete');

                    $formInputs = array('intitule' => null, 'idDiplome' => $this->db->findAll('VueLabelDiplome'));
                    $formActions = array('form' => '/web/formations/'.$params['id'], 'back' => '/web/formations?action=show'); 
                    $hiddenInput = 'idFormation';
                    
                    $this->data = $this->db->findOne('Formation', $params['id']);                    
    
                    include('view2/forms.php');
                    
                    break;

                case "delete":
                    
                    $res = $this->db->callProcedure("SupprimerStatut", array("idStatut" => $params['id']));
                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Success_Statut enseignant supprimé'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Fail_Echec de la suppression du statut'));                        
                    }
                    $this->redirect('/referentiels/statuts?action=show');
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