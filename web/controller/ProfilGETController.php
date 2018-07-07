

<?php

include_once('Controller.php');

/*
 * Modifier un service existant et rediriger vers la liste des services avec un message
 */
class ProfilGETController extends Controller {
    
    public function render($args=null){
   
        $this->namespace = 'Mon profil';
        /*verifier auth*/
        $user = $this->auth->getUserInfos();
        if (!$user) $this->request->redirect('/auth?action=process');
        
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

        $formActions = array('form' => '/web/profil', 'back' => '/web' . $this->request->getLastDifferentUrl()); 
        
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