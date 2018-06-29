

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
                    $this->pageType = 'Table';
                    $this->title = 'Tous les Diplômes';
                    
                    $this->data = $this->db->findAll('VueListeDiplome');
                    $titleButton = array(array('icon' => 'add', 'action' => '/web/referentiels/diplomes?action=add', 'enabled'=> $this->isUserAdmin()),
                                    array('icon' => 'download', 'action' => '/web/referentiels/diplomes?action=download', 'enabled'=> $this->isUserAdmin()));

                    $tableAction = '/web/referentiels/diplomes';
                    //var_dump($_SESSION['message']);
                    include('view2/tables.php');
                    break;

                case "add":

                    $this->pageType = 'New';
                    $this->pageName = 'Nouveau Diplôme';
                    $this->title = 'Noveau Diplôme';
                    $titleButton = null;
                    
                    $this->data = null;

                    //(IN p_nom VARCHAR(45), IN p_idDiplome INT)
                    $formInputs = array('intitule' => null);
                    
                    $formActions = array('form' => '/web/referentiels/diplomes', 'back' => '/web/referentiels/diplomes?action=show'); 
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
                    
                    $this->pageType = 'Edit';
                    $this->title = 'Modification de la formation n°'.$params['id'];

                    $titleButton = array('icon' => 'delete', 'action' => '/web/cours/'.$params['id'].'?action=delete');

                    $formInputs = array('intitule' => null, 'idDiplome' => $this->db->findAll('VueLabelDiplome'));
                    $formActions = array('form' => '/web/formations/'.$params['id'], 'back' => '/web/formations?action=show'); 
                    $hiddenInput = 'idFormation';
                    
                    $this->data = $this->db->findOne('Formation', $params['id']);                    
    
                    include('view2/forms.php');
                    
                    break;

                case "delete":
                    //var_dump($params['id']);
                    $id = $params['id'];
                    $res = $this->db->callProcedure("SupprimerDiplome", array("idDiplome" => $id));
                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Success_Diplôme supprimé'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Fail_Echec de la requête'));                        
                    }
                    $this->redirect('/referentiels/diplomes?action=show');
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