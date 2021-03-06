

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class DiplomesGETController extends Controller {

    public function render($args=null){
        $this->namespace = 'Diplômes';

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
                    $this->title = 'Tous les Diplômes';

                    $this->data = $this->db->findAll('VueListeDiplome');
                    $titleButton = array(array('icon' => 'add', 'action' => '/web/referentiels/diplomes?action=add', 'enabled'=> $this->auth->isUserAdmin()),
                                    array('icon' => 'download', 'action' => '/web/referentiels/diplomes?action=download', 'enabled'=> $this->auth->isUserAdmin()));

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
                
                case "download":
                    $data = $this->data = $this->db->findAll('VueListeDiplome');
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
                    $this->title = 'Diplôme n°'.$params['id'];

                    $this->data = $this->db->findOne('Diplome', $params['id']);                    
                    if (!$this->data) $this->request->force('404');

                    $prevNext = $this->db->findPreviousNext($params['id'], 'Diplome');
                    
                    $titleButton = array(array('icon' => 'previous', 
                                                'action' => $prevNext['prev']? '/web/referentiels/diplomes/'. $prevNext['prev'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['prev']? TRUE : FALSE),
                                         array('icon' => 'next', 
                                                'action' => $prevNext['next']? '/web/referentiels/diplomes/'. $prevNext['next'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['next']? TRUE : FALSE)
                                            );

                    $formInputs = array('intitule' => null);
                    
                    $formActions = array('form' => '/web/referentiels/diplomes/'.$params['id'],
                                        'back' => '/web/referentiels/diplomes?action=show',
                                        'delete' => '/web/referentiels/diplomes/'.$params['id'].'?action=delete');

                    $hiddenInput = 'idDiplome';

                    include('view2/forms.php');

                    break;

                case "delete":
                    //var_dump($params['id']);
                    $id = $params['id'];
                    $res = $this->db->callProcedure("SupprimerDiplome", array("idDiplome" => $id));
                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Diplôme supprimé.'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));
                    }
                    $this->request->redirect('/referentiels/diplomes?action=show');
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
