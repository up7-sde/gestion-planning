<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class EnseignantsGETController extends Controller {

    public function render($args=null){

        $this->namespace = 'Enseignants';
        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth?action=process');

        /*on récupère tous les types de params*/
        $params = $this->getParams();
        $extraParams = $this->getExtraParams();

        /*
        case
        /cours?action=(show|add|download)
        */
        if (!$params && !!$extraParams && isset($extraParams['action'])){
            //echo "no prams!!";

            switch ($extraParams['action']) {
                case "show":
                    // Get sans argument : vue de la liste
                    $this->pageType = 'Table';
                    $this->title = 'Enseignants';
                    $this->data = $this->db->findAll('VueListeEnseignant');

                    $titleButton = array(
                        array('icon' => 'add', 'action' => '/web/enseignants?action=add', 'enabled'=> $this->isUserAdmin()),
                        array('icon' => 'download', 'action' => '/web/enseignants?action=download','enabled'=> $this->isUserAdmin())

                    );

                    $tableAction = '/web/enseignants';
                    //var_dump($_SESSION['message']);
                    include('view2/tables.php');
                    break;

                case "add":
                    $this->pageType = 'New';
                    $this->title = "Nouvel Enseignant";

                    $titleButton = null;

                    $this->data = null;

                    //(IN p_nom VARCHAR(45), IN p_prenom VARCHAR(45), IN p_idStatut INT, IN p_depEco INT)
                    $formInputs = array('nom' => null,
                                        'prenom' => null,
                                        'idStatut' => $this->db->findAll('VueLabelStatut'),
                                        'depEco' => array(array('id' => 1, 'nom' => 'SDE'), array('id' => 0, 'nom' => 'hors-SDE')));

                    //if(`sde`.`Enseignant`.`depEco`, "SDE", "Hors SDE") AS Departement,
                    $hiddenInput = null;

                    $formActions = array('form' => '/web/enseignants', 'back' => '/web/enseignants?action=show');

                    include('view2/forms.php');
                    break;

                case "download":
                    $data = $this->data = $this->db->findAll('VueListeEnseignant');
                    $this->fileMaker->passToBrowser($data);
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
                    $this->title = 'Enseignant n°'.$params['id'];

                    $titleButton = array(
                        array('icon' => 'delete', 'action' => '/web/enseignants/'.$params['id'].'?action=delete')
                    );

                    //(IN p_idEnseignant INT, IN p_nom VARCHAR(45), IN p_prenom VARCHAR(45), IN p_idStatut INT, IN p_depEco TINYINT)
                    $formInputs = array('nom' => null,
                                        'prenom' => null,
                                        'idStatut' => $this->db->findAll('VueLabelStatut'),
                                        'depEco' => array(array('id' => 1, 'nom' => 'SDE'), array('id' => 0, 'nom' => 'hors-SDE')));

                    $formActions = array('form' => '/web/enseignants/'.$params['id'],
                                            'back' => '/web/enseignants?action=show',
                                            'delete' => '/web/enseignants/'.$params['id'].'?action=delete');

                    $hiddenInput = 'idEnseignant';

                    $this->data = $this->db->findOne('Enseignant', $params['id']);

                    include('view2/forms.php');

                    break;

                case "delete":
                    $id = $params['id'];
                    $res = $this->db->callProcedure("SupprimerEnseignant", array("idEnseignant" => $params['id']));

                    if ($res) {
                        $this->messenger->push(array('status'=>'success', 'message'=>'Enseignant supprimé.'));
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la requête'));                        
                    }

                    $this->redirect('/enseignants?action=show');
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
