<?php

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
}

?>