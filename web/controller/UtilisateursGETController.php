<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class UtilisateursGETController extends Controller {
    
    public function render($args=null){
   
        $this->namespace = 'Utilisateurs';

        /*verifier auth*/
        $user = $this->auth->getUserInfos();
        if (!$user) $this->request->redirect('/auth?action=process');
        if (!$this->auth->isUserAdmin()) throw new Exception('401');
        
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
                    $this->title = 'Tous les utilisateurs';
                    $this->data = $this->db->findAll('VueListeUtilisateur');
                    
                    $titleButton = array(
                        array('icon' => 'add', 'action' => '/web/utilisateurs?action=add', 'enabled'=> $this->auth->isUserAdmin()),
                        array('icon' => 'download', 'action' => '/web/utilisateurs?action=download', 'enabled'=> $this->auth->isUserAdmin())
                        
                    );

                    $tableAction = '/web/utilisateurs';
                    //var_dump($_SESSION['message']);
                    include('view2/tables.php');
                    break;

                case "add":

                    $this->pageType = 'New';
                    $this->title = "Nouvel utilisateur";
                    
                    $this->data = null;

                    $titleButton = null;
                    
                    $formInputs = array(
                        'login' => null,
                        'email' => null,
                        'mdp' => null,
                        'mdp2' => null,
                        'headerColor' => null,
                        'authLevel' => array(array('id'=> 1, 'nom'=>'Oui'), array('id'=> 0, 'nom'=>'Non')),
                    );
            
                    
                    $formActions = array('form' => '/web/utilisateurs', 'back' => '/web/utilisateurs?action=show'); 
                    $hiddenInput = null;
                    
                    include('view2/forms.php');
                    break;

                case "download":
                    $data = $this->data = $this->db->findAll('VueListeUtilisateur');
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

                    $this->pageType = 'User';
                    $this->title = 'Utilisateur n°'.$params['id'];

                    $formInputs = array('idEnseignant' =>  $this->db->findAll('VueLabelEnseignant'), 
                                        'idTypeService' => $this->db->findAll('VueLabelTypeService'), 
                                        'annee' => null,
                                        'apogee' => $this->db->findAll('VueLabelEnseignement'), 
                                        'nbHeures' => null,
                                        'commentaire' => null);
                    
                    $hiddenInput = 'idService';

                    $formActions = array('form' => '#', 'back' => '/web/cours/?action=show'); 
                    
                    $this->data = $this->db->findOne('Service', $params['id']);                    
    
                    include('view2/forms.php');
                    
                    break;

                case "delete":

                    
                    $res = $this->db->callProcedure("SupprimerUtilisateur", array("idService" => $params['id']));
                    
                    if ($res) {
                        $this->messenger->push(array(
                            'status'=>'success', 
                            'message'=>'Utilisateur n°'.$params['id'].' supprimé')
                        );
                    } else {
                        $this->messenger->push(array('status'=>'fail', 'message'=>'Echec de la suppression'));                        
                    }

                    $this->request->redirect('/utilisateurs?action=show');
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