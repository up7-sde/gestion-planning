<?php
/*refactor avec une liste par form*/
/*faire la même chose avec les tables*/
class Model {
    public static $attributes = array(
        'idService' =>
        array(
            'name' => 'idService',
            'alias' => 'Cours',
            'type' => PDO::PARAM_INT,
            'inputType' => 'hidden',
            'default' => null
        ),
        'idEnseignant' =>
        array(
            'name' => 'Enseignant_idEnseignant',
            'alias' => 'Enseignant',
            'type' => PDO::PARAM_INT,
            'inputType' => 'options',
            'default' => null
        ),
        'idTypeService' =>
        array(
            'name' => 'TypeService_idTypeService',
            'alias' => 'Type de Cours',
            'type' => PDO::PARAM_INT,
            'inputType' => 'radio',
            'default' => null
        ),
        'annee' =>
        array(
            'name' => 'annee',
            'alias' => 'Année',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 2018
        ),

        'apogee' =>
        array(
            'name' => 'Enseignement_apogee',
            'alias' => 'Référence Apogée',
            'type' => PDO::PARAM_STR,
            'inputType' => 'options',
            'default' => null
        ),

        'nbHeures' =>
        array(
            'name' => 'nbHeures',
            'alias' => 'Nombre d\'heures',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 4
        ),

        'nom' =>
        array(
            'name' => 'nom',
            'alias' => 'Nom',
            'type' => PDO::PARAM_STR,
            'inputType' => 'text',
            'default' => 'Nom'
        ),

        'prenom' =>
        array(
            'name' => 'prenom',
            'alias' => 'Prénom',
            'type' => PDO::PARAM_STR,
            'inputType' => 'text',
            'default' => 'Prénom'
        ),
       
        'idStatut' =>
        array(
            'name' => 'Statut_idStatut',
            'alias' => 'Statut',
            'type' => PDO::PARAM_INT,
            'inputType' => 'options',
            'default' => 'Statut'
        ),

        'depEco' =>
        array(
            'name' => 'depEco',
            'alias' => 'Département',
            'type' => PDO::PARAM_INT,
            'inputType' => 'radio',
            'default' => 'Département'
        ),

        'intitule' =>
        array(
            'name' => 'nom',
            'alias' => 'Intitulé',
            'type' => PDO::PARAM_STR,
            'inputType' => 'text',
            'default' => 'Intitulé'
        ),

        'idDiplome' =>
        
        array(
            'name' => 'Diplome_idDiplome',
            'alias' => 'Diplôme',
            'type' => PDO::PARAM_STR,
            'inputType' => 'radio',
            'default' => 'Diplôme'
        ),

        'hCM' =>
        array(
            'name' => 'heureCM',
            'alias' => 'Heures de CM',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 0
        ),
        'hTP' =>
        array(
            'name' => 'hTPtotal',
            'alias' => 'Heures de TP',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 0
        ),
        'semestre' =>
        array(
            'name' => 'semestre',
            'alias' => 'Semestre',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 0
        ),
        'nbGroupes' =>
        array(
            'name' => 'nbGroupe',
            'alias' => 'Nombre de groupes',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 0
        ),
        'idFormation' =>
        array(
            'name' => 'intitule',
            'alias' => 'Formation',
            'type' => PDO::PARAM_INT,
            'inputType' => 'options',
            'default' => 'Formation'
        ),
        'apogee2' =>
        array(
            'name' => 'nom',
            'alias' => 'Code Apogée',
            'type' => PDO::PARAM_INT,
            'inputType' => 'text',
            'default' => 'Code Apogée'
        )
    );

    
    public static $tables = array(

        /*table enseignants */
        'Enseignants' => array( //la table dans la base
            'nom' => array( //nom dans la bdd
                'name' => 'Nom', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),
            'prenom' => array( //nom dans la bdd
                'name' => 'Prénom', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'Departement' => array( //nom dans la bdd
                'name' => 'Département', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'Tituaire' => array( //nom dans la bdd
                'name' => 'Titulaire', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'Categorie' => array( //nom dans la bdd
                'name' => 'Catégorie', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'HeuresDues' => array( //nom dans la bdd
                'name' => 'Heures dues', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'HeuresAffectees' => array( //nom dans la bdd
                'name' => 'Heures afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => 'HeuresDues', //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
        ),

        /**table enseignements */
        'Enseignements' => array( //la table dans la base
            'apogee2' => array( //nom dans la bdd
                'name' => 'Référence Apogée', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),
            'intitule' => array( //nom dans la bdd
                'name' => 'Intitulé', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'heureCM' => array( //nom dans la bdd
                'name' => 'Heures CM', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),

            'heureCMAffectee' => array( //nom dans la bdd
                'name' => 'Heures CM afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => 'heureCM', //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'hTPparGroupe' => array( //nom dans la bdd
                'name' => 'Heures TP par groupe', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'nbGroupe' => array( //nom dans la bdd
                'name' => 'Nombre de groupes', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'hTPtotal' => array( //nom dans la bdd
                'name' => 'Heures TP total', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'heureTPAffectee' => array( //nom dans la bdd
                'name' => 'Heures TP afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => 'hTPtotal', //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'semestre' => array( //nom dans la bdd
                'name' => 'Semestre', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'formation' => array( //nom dans la bdd
                'name' => 'Formation', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'idFormation' => array( //nom dans la bdd
                'name' => 'Id formation', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => FALSE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'diplome' => array( //nom dans la bdd
                'name' => 'Diplôme', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            )),

        /**Table services */
        'Cours' => array( //la table dans la base
            'apogee' => array( //nom dans la bdd
                'name' => 'Code Apogée', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),
            'intitule' => array( //nom dans la bdd
                'name' => 'Intitulé', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'type' => array( //nom dans la bdd
                'name' => 'Type', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'heure' => array( //nom dans la bdd
                'name' => 'Nombre d\'heures', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'annee' => array( //nom dans la bdd
                'name' => 'Année', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'idEnseignant' => array( //nom dans la bdd
                'name' => '', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => FALSE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'nom' => array( //nom dans la bdd
                'name' => 'Nom enseignant', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'prenom' => array( //nom dans la bdd
                'name' => 'Prénom enseignant', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'formation' => array( //nom dans la bdd
                'name' => 'Formation', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'diplome' => array( //nom dans la bdd
                'name' => 'Diplôme', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            )
        ),
        
        /**Table des forrmations */
        'Formations' => array( //la table dans la base
            'diplome' => array( //nom dans la bdd
                'name' => 'Diplôme', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),
            'formation' => array( //nom dans la bdd
                'name' => 'Formation', //nom à afficher
                'type' => 1, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'heureCM' => array( //nom dans la bdd
                'name' => 'Heures CM', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'heureCMAffectee' => array( //nom dans la bdd
                'name' => 'Heures CM afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => 'heureCM', //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'heureTP' => array( //nom dans la bdd
                'name' => 'Heures TP', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'heureTPAffectee' => array( //nom dans la bdd
                'name' => 'Heures TP afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite 
                'show' => TRUE, //on le montre ou pas
                'gauge' => 'heureTP', //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            )
        )
        /*fonctionnement pour les tableaux */
    );
}

?>