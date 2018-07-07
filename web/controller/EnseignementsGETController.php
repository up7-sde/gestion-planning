<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class EnseignementsGETController extends Controller {

    public function render($args=null){

        $this->namespace = 'Enseignements';
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
                    $this->title = 'Tous les Enseignements';
                    //$this->data = $this->db->findChunk('VueListeEnseignement', 10, 0);
                    $this->data = $this->db->findAll('VueListeEnseignement');

                    $titleButton = array(
                        array('icon' => 'add', 'action' => '/web/enseignements?action=add', 'enabled'=> $this->auth->isUserAdmin()),
                        array('icon' => 'download', 'action' => '/web/enseignements?action=download', 'enabled'=> $this->auth->isUserAdmin())

                    );

                    $tableAction = '/web/enseignements';
                    //var_dump($_SESSION['message']);
                    include('view2/tables.php');
                    break;

                case "add":
                    $this->pageType = 'New';
                    $this->title = 'Nouvel Enseignement';
                    $titleButton = null;

                    $this->data = null;

                    //(IN p_apogee VARCHAR(45), IN p_intitule VARCHAR(45), IN p_heureCM INT, IN p_heureTP 0000000INT, IN p_semestre INT, IN p_nbGroupes INT, IN p_idFormation INT)
                    $formInputs = array('apogee2' => $this->db->findAll('VueLabelEnseignement'),
                                        'intitule' => null,
                                        'hCM' => null,
                                        'hTP' => null,
                                        'semestre' => array(
                                            array('id' => 1, 'nom' => 1),
                                            array('id' => 2, 'nom' => 2),
                                            array('id' => 3, 'nom' => 3),
                                            array('id' => 4, 'nom' => 4),
                                            array('id' => 5, 'nom' => 5),
                                            array('id' => 6, 'nom' => 6),
                                            array('id' => 7, 'nom' => 7),
                                            array('id' => 8, 'nom' => 8),
                                            array('id' => 9, 'nom' => 9),
                                            array('id' => 10, 'nom' => 10),
                                        ),
                                        'nbGroupes' => null,
                                        'idFormation' => $this->db->findAll('VueLabelFormation'));

                    $formActions = array('form' => '/web/enseignements', 'back' => '/web/enseignements?action=show');
                    $hiddenInput = null;

                    include('view2/forms.php');
                    break;

                case "download":
                    $data = $this->data = $this->db->findAll('VueListeEnseignement');
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
                    $this->title = 'Enseignement #'.$params['id'];

                    $titleButton = array(array('icon' => 'delete', 'action' => '/web/enseignements/'.$params['id'].'?action=delete'));

                    $formInputs = array('apogee2' => null,
                                        'intitule' => null,
                                        'hCM' => null,
                                        'hTP' => null,
                                        'semestre' => array(
                                            array('id' => 1, 'nom' => 1),
                                            array('id' => 2, 'nom' => 2),
                                            array('id' => 3, 'nom' => 3),
                                            array('id' => 4, 'nom' => 4),
                                            array('id' => 5, 'nom' => 5),
                                            array('id' => 6, 'nom' => 6),
                                            array('id' => 7, 'nom' => 7),
                                            array('id' => 8, 'nom' => 8),
                                            array('id' => 9, 'nom' => 9),
                                            array('id' => 10, 'nom' => 10),
                                        ),
                                        'nbGroupes' => null,
                                        'idFormation' => $this->db->findAll('VueLabelFormation'));

                    $formActions = array('form' => '/web/enseignements/'.$params['id'],
                                        'back' => '/web/enseignements?action=show',
                                        'delete' => '/web/enseignements/'.$params['id'].'?action=delete');
                    $hiddenInput = 'apogee2';

                    $this->data = $this->db->findOne('VueListeEnseignement', $params['id'], 'apogee2', TRUE);

                    include('view2/forms.php');

                    break;

                case "delete":
                    $id = $params['id'];
                    $res = $this->db->callProcedure("SupprimerEnseignement", array("apogee" => $params['id']));

                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Enseignement supprimé'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la suppression'));                        
                    }

                    $this->request->redirect('/enseignements?action=show');
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
