<?php
/*refactor avec une liste par form*/
/*faire la même chose avec les tables*/
class Model {
    public static $inputs = array(

        'idService' =>
        array(
            'name' => 'idService',
            'alias' => 'Cours',
            'type' => PDO::PARAM_INT,
            'inputType' => 'hidden',
            'default' => null,
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
        ),
        'idEnseignant' =>
        array(
            'name' => 'Enseignant_idEnseignant',
            'alias' => 'Enseignant',
            'type' => PDO::PARAM_INT,
            'inputType' => 'options',
            'default' => null,
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null
        ),
        'idTypeService' =>
        array(
            'name' => 'TypeService_idTypeService',
            'alias' => 'Type de Cours',
            'type' => PDO::PARAM_INT,
            'inputType' => 'options',
            'default' => null,
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null
        ),
        'annee' =>
        array(
            'name' => 'annee',
            'alias' => 'Année',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 'YYYY',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
            'min' => 1900,
            'max' => null,
            'step' => 1
        ),

        'apogee' =>
        array(
            'name' => 'Enseignement_apogee',
            'alias' => 'Enseignement',
            'type' => PDO::PARAM_STR,
            'inputType' => 'options',
            'default' => 'Enseignement',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null
        ),

        'nbHeures' =>
        array(
            'name' => 'nbHeures',
            'alias' => 'Nombre d\'heures',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 'Entrez un nombre d\'heures',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => 'Doit être un entier.',
            'min' => 0,
            'max' => null,
            'step' => 1
        ),

        'nom' =>
        array(
            'name' => 'nom',
            'alias' => 'Nom',
            'type' => PDO::PARAM_STR,
            'inputType' => 'text',
            'default' => 'Entrez un nom',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
            'pattern' => null
        ),

        'prenom' =>
        array(
            'name' => 'prenom',
            'alias' => 'Prénom',
            'type' => PDO::PARAM_STR,
            'inputType' => 'text',
            'default' => 'Entrez un prénom',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
            'pattern' => null
        ),

        'idStatut' =>
        array(
            'name' => 'Statut_idStatut',
            'alias' => 'Statut',
            'type' => PDO::PARAM_INT,
            'inputType' => 'options',
            'default' => 'Statut',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null
        ),

        'depEco' =>
        array(
            'name' => 'depEco',
            'alias' => 'Département',
            'type' => PDO::PARAM_INT,
            'inputType' => 'radio',
            'default' => 'Département',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null
        ),

        'intitule' =>
        array(
            'name' => 'nom',
            'alias' => 'Intitulé',
            'type' => PDO::PARAM_STR,
            'inputType' => 'text',
            'default' => 'Choisissez un intitulé',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
            'pattern' => null
        ),

        'idDiplome' =>
        array(
            'name' => 'Diplome_idDiplome',
            'alias' => 'Diplôme',
            'type' => PDO::PARAM_INT,
            'inputType' => 'options',
            'default' => 'Diplôme',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null
        ),

        'hCM' =>
        array(
            'name' => 'heureCM',
            'alias' => 'Heures de CM',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 'Entrez un nombre d\'heures de CM',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
            'min' => 0,
            'max' => null,
            'step' => 1
        ),
        'hTP' =>
        array(
            'name' => 'hTPtotal',
            'alias' => 'Heures de TP',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 'Entrez un nombre d\'heures de TP',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
            'min' => 0,
            'max' => null,
            'step' => 1
        ),
        'semestre' =>
        array(
            'name' => 'semestre',
            'alias' => 'Semestre',
            'type' => PDO::PARAM_INT,
            'inputType' => 'options',
            'default' => 'Choisissez un semestre',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => 'De 1 à 6 pour la Licence, de 7 à 10 pour le Master'
        ),
        'nbGroupes' =>
        array(
            'name' => 'nbGroupe',
            'alias' => 'Nombre de groupes',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 'Entrez un nombre de groupe',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => 'Le nombre de groupe doit être un chiffre entier.',
            'min' => 0,
            'max' => 20,
            'step' => 1
        ),
        'idFormation' =>
        array(
            'name' => 'intitule',
            'alias' => 'Formation',
            'type' => PDO::PARAM_INT,
            'inputType' => 'options',
            'default' => 'Formation',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null
        ),
        'apogee2' =>
        array(
            'name' => 'nom',
            'alias' => 'Code Apogée',
            'type' => PDO::PARAM_STR,
            'inputType' => 'text',
            'default' => 'Entrez un code apogée',
            'required' => 'required',
            'invalid' => 'Le champs n\'est pas valide',
            'valid' => 'Le champs est valide',
            'help' => 'Le code apogée ne doit contenir que des caractères alphanumériques et aucun espace.',
            'pattern' => '^[a-zA-Z0-9]+$'
        ),
        'id' =>
        array(
            'name' => 'id',
            'alias' => 'Code Apogée',
            'type' => PDO::PARAM_STR,
            'inputType' => 'text',
            'default' => 'Entrez un code apogée',
            'required' => 'required',
            'invalid' => 'Le champs n\'est pas valide',
            'valid' => 'Le champs est valide',
            'help' => 'Le code apogée ne doit contenir que des caractères alphanumériques et aucun espace.',
            'pattern' => '^[a-zA-Z0-9]+$'
        ),
        'commentaire' =>
        array(
            'name' => 'nom',
            'alias' => 'Commentaire',
            'type' => PDO::PARAM_STR,
            'inputType' => 'area',
            'default' => 'Ajoutez un commentaire ici',
            'required' => '',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => 'Commentaire pour les cours spéciaux (facultatif)',
        ),
        'poids' =>
        array(
            'name' => 'poids',
            'alias' => 'Poids',
            'type' => PDO::PARAM_STR,
            'inputType' => 'number',
            'default' => 'Entrez un poids',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => 'Vous devez mettre un point pour les décimales (ex: 1.5)',
            'min' => 0,
            'max' => null,
            'step' => 0.5
        ),
        'titulaire' =>
        array(
            'name' => 'titulaire',
            'alias' => 'Est titulaire?',
            'type' => PDO::PARAM_INT,
            'inputType' => 'radio',
            'default' => 'Poids (ex : 1)',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null
        ),
        'heureService' =>
        array(
            'name' => 'heureService',
            'alias' => 'Heures de service',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 'Choisissez un nombre d\'heures',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
            'min' => 0,
            'max' => null,
            'step' => null
        ),

        'idUtilisateur' =>
        array(
            'name' => 'idUtilisateur',
            'alias' => 'id',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 'id Utilisateur',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
            'min' => null,
            'max' => null,
            'step' => null
        ),
        'login' =>
        array(
            'name' => 'nom',
            'alias' => 'Nom d\'utilisateur',
            'type' => PDO::PARAM_STR,
            'inputType' => 'text',
            'default' => 'Entrez un nom d\'utilisateur',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
            'pattern' => null
        ),
        'email' =>
        array(
            'name' => 'email',
            'alias' => 'Email',
            'type' => PDO::PARAM_STR,
            'inputType' => 'email',
            'default' => 'Choisissez un email',
            'required' => 'required',
            'invalid' => 'Vous devez entrer un email valide !',
            'valid' => 'Ok! Email valide',
            'help' => null,
            'pattern' => null
        ),
        'mdp' =>
        array(
            'name' => 'mdp',
            'alias' => 'Mot de passe',
            'type' => PDO::PARAM_STR,
            'inputType' => 'password',
            'default' => 'Choisissez un mot de passe',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => '8 à 32 caractères contenant au moins : une minuscule, une majuscule, un caractère spécial (!@#$%^&*_=+-)',
            'pattern' => '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,32}$'
        ),
        //
        'mdp2' =>
        array(
            'name' => 'mdp',
            'alias' => 'Confirmation',
            'type' => PDO::PARAM_STR,
            'inputType' => 'password',
            'default' => 'Confirmez le mot de passe',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => 'Les deux mots de passe doivent correspondre',
            'pattern' => '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,32}$'
        ),
        'bckColor' =>
        array(
            'name' => 'bckColor',
            'alias' => 'Thème',
            'type' => PDO::PARAM_STR,
            'inputType' => 'radio',
            'default' => 'Thème',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null
        ),
        'headerColor' =>
        array(
            'name' => 'headerColor',
            'alias' => 'Couleur',
            'type' => PDO::PARAM_STR,
            'inputType' => 'color',
            'default' => 'Couleur',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => 'Une couleur pour la barre de navigation'
        ),
        'authLevel' =>
        array(
            'name' => 'authLevel',
            'alias' => 'Est administrateur?',
            'type' => PDO::PARAM_INT,
            'inputType' => 'radio',
            'default' => null,
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null
        ),
        'annee1' =>
        array(
            'name' => 'annee1',
            'alias' => 'Année cible',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 'YYYY',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
            'min' => 1900,
            'max' => null,
            'step' => null
        ),
        'annee2' =>
        array(
            'name' => 'annee2',
            'alias' => 'Année de destination',
            'type' => PDO::PARAM_INT,
            'inputType' => 'number',
            'default' => 'YYYY',
            'required' => 'required',
            'invalid' => 'Non valide',
            'valid' => 'Valide',
            'help' => null,
            'min' => 1900,
            'max' => null,
            'step' => null
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
            'Titulaire' => array( //nom dans la bdd
                'name' => 'Titulaire?', //nom à afficher
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
                'name' => 'H. dues', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'HeuresAffectees' => array( //nom dans la bdd
                'name' => 'H. afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => 'HeuresDues', //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'pctH' => array( //nom dans la bdd
                'name' => '% H. afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            )
        ),

        /**table enseignements */
        'Enseignements' => array( //la table dans la base
            'apogee2' => array( //nom dans la bdd
                'name' => 'Réf. Apogée', //nom à afficher
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
                'name' => 'H. CM', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),

            'heureCMAffectee' => array( //nom dans la bdd
                'name' => 'H. CM afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => 'heureCM', //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'pctCM' => array( //nom dans la bdd
                'name' => '% h. CM afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'hTPparGroupe' => array( //nom dans la bdd
                'name' => 'H. TP/groupe', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'nbGroupe' => array( //nom dans la bdd
                'name' => 'Nb groupes', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'hTPtotal' => array( //nom dans la bdd
                'name' => 'H. TP total', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'heureTPAffectee' => array( //nom dans la bdd
                'name' => 'H. TP afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => 'hTPtotal', //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'pctTP' => array( //nom dans la bdd
                'name' => '% h. TP afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
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
                'name' => 'Réf. apogée', //nom à afficher
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
                'name' => 'Nb h.', //nom à afficher
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
                'name' => 'Nom prof.', //nom à afficher
                'type' => 1, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'prenom' => array( //nom dans la bdd
                'name' => 'Prénom prof.', //nom à afficher
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
                'type' => 1, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'commentaire' => array( //nom dans la bdd
                'name' => 'Commentaire', //nom à afficher
                'type' => 1, //type pr alignement gauche droite
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
                'name' => 'H. CM', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'heureCMAffectee' => array( //nom dans la bdd
                'name' => 'H. CM afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'pctCM' => array( //nom dans la bdd
                'name' => '%H. CM affectées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'heureTP' => array( //nom dans la bdd
                'name' => 'H. TP', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'heureTPAffectee' => array( //nom dans la bdd
                'name' => 'H. TP afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            ),
            'pctTP' => array( //nom dans la bdd
                'name' => '%H. TP afféctées', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE //avec quelle colonne de la table on fait le pourcentage
            )
        ),

        /*table diplomes*/
        'Diplômes' => array( //la table dans la base
            'nom' => array( //nom dans la bdd
                'name' => 'Nom', //nom à afficher
                'type' => 1, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            )
        ),

        /*table diplomes*/
        'Types de cours' => array( //la table dans la base
            'nom' => array( //nom dans la bdd
                'name' => 'Nom', //nom à afficher
                'type' => 1, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),
            'poids' => array( //nom dans la bdd
                'name' => 'Poids', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            )
            ),

            /*table diplomes*/
        'Statuts Enseignant' => array( //la table dans la base
            'nom' => array( //nom dans la bdd
                'name' => 'Intitulé', //nom à afficher
                'type' => 1, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),
            'heureService' => array( //nom dans la bdd
                'name' => 'H. dûes', //nom à afficher
                'type' => 0, //type pr alignement gauche droite Libbéllé
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),
            'titulaire' => array( //nom dans la bdd
                'name' => 'Titulaire?', //nom à afficher
                'type' => 1, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            )
            ),
               /*table utilisateurs*/
        'Utilisateurs' => array( //la table dans la base
            'nom' => array( //nom dans la bdd
                'name' => 'Nom', //nom à afficher
                'type' => 1, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),
            'email' => array( //nom dans la bdd
                'name' => 'Email', //nom à afficher
                'type' => 1, //type pr algnement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),
            'mdp' => array( //nom dans la bdd
                'name' => 'MDP ', //nom à afficher
                'type' => 1, //type pr alignement gauche droite
                'show' => FALSE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),

            'bckColor' => array( //nom dans la bdd
                'name' => 'Thème', //nom à afficher
                'type' => 1, //type pr alignement gauche droite
                'show' => FALSE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),
            'headerColor' => array( //nom dans la bdd
                'name' => 'Couleur', //nom à afficher
                'type' => 1, //type pr alignement gauche droite
                'show' => FALSE ,//on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            ),
            'authLevel' => array( //nom dans la bdd
                'name' => 'Admin?', //nom à afficher
                'type' => 0, //type pr alignement gauche droite
                'show' => TRUE, //on le montre ou pas
                'gauge' => FALSE, //avec quelle colonne de la table on fait le pourcentage
                'labels' => FALSE
            )
        )
        /*fonctionnement pour les tableaux */
    );
}

?>
