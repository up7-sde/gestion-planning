<?php

class Model {
    
    public static $attributes = array(
        array(
            'name' => 'idService',
            'type' => PDO::PARAM_INT
        ),
        array(
            'name' => 'idEnseignant',
            'type' => PDO::PARAM_INT
        ),
        array(
            'name' => 'idTypeService',
            'type' => PDO::PARAM_INT
        ),
        array(
            'name' => 'annee',
            'type' => PDO::PARAM_INT
        ),
        array(
            'name' => 'apogee',
            'type' => PDO::PARAM_STR
        ),
        array(
            'name' => 'nbHeures',
            'type' => PDO::PARAM_INT
        )
    );

    /*entitees pour le storage en session*/
    public $objects = array(
        0 => 'uneVue',
        1 => 'uneAutreVue'
    );
}

?>