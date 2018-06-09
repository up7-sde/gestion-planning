<?php

class Model {
    public static $attributes = array(
        'idService' =>
        array(
            'name' => 'idService',
            'alias' => 'Cours',
            'type' => PDO::PARAM_INT,
            'inputType' => 'hidden',
            'optionsEntity' => null,
            'default' => null
        ),
        'idEnseignant' =>
        array(
            'name' => 'idEnseignant',
            'alias' => 'Enseignant',
            'type' => PDO::PARAM_INT,
            'inputType' => 'options',
            'optionsEntity' => null,
            'default' => null
        ),
        'idTypeService' =>
        array(
            'name' => 'idTypeService',
            'alias' => 'Type de Cours',
            'type' => PDO::PARAM_INT,
            'inputType' => 'radio',
            'optionsEntity' => null,
            'default' => null
        ),
        'annee' =>
        array(
            'name' => 'annee',
            'alias' => 'Année',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'optionsEntity' => null,
            'default' => 2018
        ),

        'apogee' =>
        array(
            'name' => 'apogee',
            'alias' => 'Référence Apogée',
            'type' => PDO::PARAM_STR,
            'inputType' => 'options',
            'optionsEntity' => null,
            'default' => null
        ),

        'nbHeures' =>
        array(
            'name' => 'nbHeures',
            'alias' => 'Nombre d\'heures',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'optionsEntity' => null,
            'default' => 4
        ),

        'nom' =>
        array(
            'name' => 'nom',
            'alias' => 'Nom',
            'type' => PDO::PARAM_STR,
            'inputType' => 'text',
            'optionsEntity' => null,
            'default' => 'Nom'
        ),

        'prenom' =>
        array(
            'name' => 'prenom',
            'alias' => 'Prénom',
            'type' => PDO::PARAM_INT,
            'inputType' => 'text',
            'optionsEntity' => null,
            'default' => 'Prénom'
        ),

        'idStatut' =>
        array(
            'name' => 'idStatut',
            'alias' => 'Statut',
            'type' => PDO::PARAM_INT,
            'inputType' => 'options',
            'optionsEntity' => null,
            'default' => 'Statut'
        ),

        'depEco' =>
        array(
            'name' => 'depEco',
            'alias' => 'depEco',
            'type' => PDO::PARAM_INT,
            'inputType' => 'radio',
            'optionsEntity' => null,
            'default' => 'depEco'
        )
    );
}

?>