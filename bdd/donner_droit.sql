-- Donner les droits sur les vues aux comptes enseignant et admin
GRANT SELECT ON `sde`.* TO 'enseignant';
GRANT SELECT ON `sde`.* TO 'admin';

-- Donner les droits d'exécution sur les procédures à l'admin
GRANT EXECUTE ON PROCEDURE `sde`.`InsererEnseignement` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierEnseignement` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`SupprimerEnseignement` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererFormation` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierFormation` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`SupprimerFormation` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererEnseignant` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierEnseignant` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`SupprimerEnseignant` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererService` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierService` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`SupprimerService` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererDiplome` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierDiplome` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`SupprimerDiplome` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererTypeService` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierTypeService` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`SupprimerTypeService` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererStatut` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierStatut` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`SupprimerStatut` TO 'admin';