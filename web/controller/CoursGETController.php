<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class CoursGETController extends Controller {
    public function render($args=null){
        
        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) $this->redirect('/auth/login');
        
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
                    $title = "Service";
                    $pageTitle = "Service | " . $user['name'];
                    $tab = $this->db->findAll('VueListeService');
                    $prefix = 'cours/'; // permettra de générer des liens dynamiquement
                    //var_dump($_SESSION['message']);
                    include('view/TabView.php');
                    break;

                case "add":
                    $title = "Nouveau service ";
                    $pageTitle = " Nouveau service | " . $user['name'];
                    $action = "/web/cours"; // debug adresse dynamique
                    $labelEnseignant = $this->db->findAll('VueLabelEnseignant');
                    $labelEnseignement = $this->db->findAll('VueLabelEnseignement');
                    $labelTypeService = $this->db->findAll('VueLabelTypeService');
                    
                    include('view/FormService.php');
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
                case "show":
                    /*vue avec toutes les infos*/
                    echo "param show";
                    break;

                case "edit":
                    $thisServiceid = $params['id'];
                    $title = "Service id " . $thisServiceid;
                    $pageTitle = "Service $thisServiceid | " . $user['name'];
                    $data = $this->db->findOne('Service', $thisServiceid);
                    $data = $data[0]; // retourne une liste d'un seul élément
                    // debug : obtenir l'url de manière dynamique
                    $action = "/web/cours/$thisServiceid"; // action du form
                    $labelEnseignant = $this->db->findAll('VueLabelEnseignant');
                    $labelEnseignement = $this->db->findAll('VueLabelEnseignement');
                    $labelTypeService = $this->db->findAll('VueLabelTypeService');
                    include('view/FormService.php');
                    break;

                case "delete":
                    $id = $params['id'];
                    $res = $this->db->callProcedure("SupprimerService", array("idService" => $params['id']));
                    $_SESSION["message"] = $res;
                    $this->redirect('/cours?action=show');
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