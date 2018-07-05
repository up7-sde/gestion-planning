

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class ProfilGETController extends Controller {
    
    public function render($args=null){
   
        $this->namespace = 'Mon profil';
        /*verifier auth*/
        $user = $this->getUserInfos();
        if (!$user) throw new Exception('401');
        
        /*on récupère tous les types de params*/
        /*var_dump($user);
        die();*/
        $this->pageType = 'Profil';
        $this->title = 'Mon profil';
        
        $titleButton = null;

        $formInputs = array(
            'login' => null,
            'email' => null,
            'mdp' => null,
            'mdp2' => null,
            'headerColor' => null
        );

        $formActions = array('form' => '/web/profil', 'back' => '/web' . $this->getLastDifferentUrl()); 
        
        $hiddenInput = 'idUtilisateur';
        
        $this->data =  array(array('idUtilisateur' => $user['id'],
                            'login' => $user['name'],
                            'email' => $user['email'],
                            'mdp' => '',
                            'headerColor' => $user['color'],
                            'authLevel' => $user['level']
                        ));                  

        include('view2/forms.php'); 
    }
}
?>