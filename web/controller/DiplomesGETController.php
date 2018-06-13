

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class DiplomesGETController extends Controller {
    
    public function render($args=null){
        $this->namespace = 'Diplômes';
        
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
                    $this->title = 'Tous les Diplômes';
                    
                    $this->data = $this->db->findAll('VueListeDiplome');
                    $titleButton = array('icon' => 'add', 'action' => '/web/referentiels/diplomes?action=add');
                    $tableAction = '/web/referentiels/diplomes';
                    //var_dump($_SESSION['message']);
                    include('view2/tables.php');
                    break;

                case "add":
                    $this->pageName = 'Nouvelle Formation';
                    $this->title = 'Nouvelle Formation';
                    $titleButton = null;
                    
                    $this->data = null;

                    //(IN p_nom VARCHAR(45), IN p_idDiplome INT)
                    $formInputs = array('intitule' => null, 
                                        'idDiplome' => $this->db->findAll('VueLabelDiplome'));
                    
                    $formActions = array('form' => '/web/formations', 'back' => '/web/formations?action=show'); 
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
                    var_dump($params['id']);
                    $id = $params['id'];
                    $res = $this->db->callProcedure("SupprimerFormation", array("idFormation" => $params['id']));
                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Success_Formation modifiée'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Fail_Echec de la requête'));                        
                    }
                    $this->redirect('/formations?action=show');
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