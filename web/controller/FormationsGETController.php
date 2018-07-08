

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class FormationsGETController extends Controller {

    public function render($args=null){

        $this->namespace = 'Formations';

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
                    $this->title = 'Toutes les formations';

                    $this->data = $this->db->findAll('VueListeFormation');

                    $titleButton = array(
                        array('icon' => 'add', 'action' => '/web/formations?action=add', 'enabled'=> $this->auth->isUserAdmin()),
                        array('icon' => 'download', 'action' => '/web/formations?action=download', 'enabled'=> $this->auth->isUserAdmin())
                    );

                    $tableAction = '/web/formations';
                    //var_dump($_SESSION['message']);
                    include('view2/tables.php');
                    break;

                case "add":
                    $this->pageType = 'New';
                    $this->title = 'Nouvelle formation';

                    $titleButton = null;

                    $this->data = null;

                    //(IN p_nom VARCHAR(45), IN p_idDiplome INT)
                    $formInputs = array('intitule' => null,
                                        'idDiplome' => $this->db->findAll('VueLabelDiplome'));

                    $formActions = array('form' => '/web/formations', 'back' => '/web/formations?action=show');
                    $hiddenInput = null;

                    include('view2/forms.php');
                    break;

                case "download":
                    $data = $this->data = $this->db->findAll('VueListeFormation');
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
                    $this->title = 'Formation n°'.$params['id'];

                    $this->data = $this->db->findOne('Formation', $params['id']);                    
                    if (!$this->data) $this->request->force('404');

                    $prevNext = $this->db->findPreviousNext($params['id'], 'Formation');
                    
                    $titleButton = array(array('icon' => 'previous', 
                                                'action' => $prevNext['prev']? '/web/formations/'. $prevNext['prev'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['prev']? TRUE : FALSE),
                                         array('icon' => 'next', 
                                                'action' => $prevNext['next']? '/web/formations/'. $prevNext['next'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['next']? TRUE : FALSE)
                                            );

                    $formInputs = array('intitule' => null, 'idDiplome' => $this->db->findAll('VueLabelDiplome'));

                    $formActions = array('form' => '/web/formations/'.$params['id'],
                                        'back' => '/web/formations?action=show',
                                        'delete' => '/web/formations/'.$params['id'].'?action=delete');

                    $hiddenInput = 'idFormation';

                    include('view2/forms.php');

                    break;

                case "delete":

                    $res = $this->db->callProcedure("SupprimerFormation", array("idFormation" => $params['id']));
                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Formation supprimée'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));
                    }
                    $this->request->redirect('/formations?action=show');
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
