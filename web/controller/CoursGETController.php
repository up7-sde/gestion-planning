<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class CoursGETController extends Controller {

    public function render($args=null){

        $this->namespace = 'Cours';

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
                    $this->title = 'Tous les cours';
                    $this->data = $this->db->findAll('VueListeService');

                    $titleButton = array(
                        array('icon' => 'add', 'action' => '/web/cours?action=add', 'enabled'=> $this->auth->isUserAdmin()),
                        array('icon' => 'download', 'action' => '/web/cours?action=download', 'enabled'=> $this->auth->isUserAdmin())

                    );

                    $tableAction = '/web/cours';
                    //var_dump($_SESSION['message']);
                    include('view2/tables.php');
                    break;

                case "add":

                    $this->pageType = 'New';
                    $this->title = "Nouveau cours";

                    $this->data = null;

                    $formInputs = array('idEnseignant' =>  $this->db->findAll('VueLabelEnseignant'),
                                        'idTypeService' => $this->db->findAll('VueLabelTypeService'),
                                        'annee' => null,
                                        'apogee' => $this->db->findAll('VueLabelEnseignement'),
                                        'nbHeures' => null,
                                        'commentaire' => null);

                    $formActions = array('form' => '/web/cours', 'back' => '/web/cours?action=show');
                    $hiddenInput = null;
                    $titleButton =null;

                    include('view2/forms.php');
                    break;

                case "download":
                    $data = $this->data = $this->db->findAll('VueListeService');
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
                    $this->title = 'Cours n°'.$params['id'];

                    $this->data = $this->db->findOne('Service', $params['id']);                    
                    if (!$this->data) $this->request->force('404');

                    $prevNext = $this->db->findPreviousNext($params['id'], 'Service');
                    
                    $titleButton = array(array('icon' => 'previous', 
                                                'action' => $prevNext['prev']? '/web/cours/'. $prevNext['prev'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['prev']? TRUE : FALSE),
                                         array('icon' => 'next', 
                                                'action' => $prevNext['next']? '/web/cours/'. $prevNext['next'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['next']? TRUE : FALSE)
                                            );

                    $formInputs = array('idEnseignant' =>  $this->db->findAll('VueLabelEnseignant'),
                                        'idTypeService' => $this->db->findAll('VueLabelTypeService'),
                                        'annee' => null,
                                        'apogee' => $this->db->findAll('VueLabelEnseignement'),
                                        'nbHeures' => null,
                                        'commentaire' => null);

                    $hiddenInput = 'idService';

                    $formActions = array('form' => '/web/cours/'.$params['id'],
                                        'back' => '/web/cours/?action=show',
                                        'delete' => '/web/cours/'.$params['id'].'?action=delete');

                    include('view2/forms.php');

                    break;

                case "delete":

                    $id = $params['id'];
                    $res = $this->db->callProcedure("SupprimerService", array("idService" => $params['id']));

                    if ($res) {
                        $this->messenger->push(array(
                            'status'=>'success',
                            'message'=>'Cours n°'.$params['id'].' supprimé')
                        );
                    } else {
                        $this->messenger->push(array(
                            'status'=>'fail',
                            'message'=>'Impossible de supprimer le cours')
                        );
                    }

                    $this->request->redirect('/cours?action=show');
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