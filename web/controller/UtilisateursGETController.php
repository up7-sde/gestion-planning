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
        if (!$this->auth->isUserAdmin()) $this->request->force('401');
        
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
                        array('icon' => 'download', 'action' => '#', 'enabled'=> FALSE)
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

                    $this->data = $this->db->findOne('TypeService', $params['id']);                    
                    if (!$this->data) throw new Exception('404');

                    $prevNext = $this->db->findPreviousNext($params['id'], 'Utilisateur');
                    
                    $titleButton = array(array('icon' => 'previous', 
                                                'action' => $prevNext['prev']? '/web/utilisateurs/'. $prevNext['prev'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['prev']? TRUE : FALSE),
                                         array('icon' => 'next', 
                                                'action' => $prevNext['next']? '/web/utilisateurs/'. $prevNext['next'] . '?action=edit' : '#', 
                                                'enabled'=> $prevNext['next']? TRUE : FALSE)
                                            );

                    $formInputs = array(
                        'login' => null,
                        'email' => null,
                        'authLevel' => array(array('id'=> 1, 'nom'=>'Oui'), array('id'=> 0, 'nom'=>'Non')),
                    );
                    
                    $hiddenInput = null;

                    $formActions = array('form' => '#', 
                                         'back' => '/web/utilisateurs/?action=show',
                                        'delete' => '/web/utilisateurs/'.$params['id'].'?action=delete'); 
                    
                    $this->data = $this->db->findOne('Utilisateur', $params['id']);                    
    
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