-- Donner les droits au compte applicatif enseignant
-- Donner les droits de selection sur les vues
GRANT SELECT ON `sde`.`VueListeService` TO 'admin';
GRANT SELECT ON `sde`.`VueListeEnseignant` TO 'admin';
GRANT SELECT ON `sde`.`VueListeEnseignement` TO 'admin';
GRANT SELECT ON `sde`.`VueListeFormation` TO 'admin';

-- Donner les droits au compte applicatif administrateur
-- Donner les droits de selection sur les vues
GRANT SELECT ON `sde`.`VueListeService` TO 'admin';
GRANT SELECT ON `sde`.`VueListeEnseignant` TO 'admin';
GRANT SELECT ON `sde`.`VueListeEnseignement` TO 'admin';
GRANT SELECT ON `sde`.`VueListeFormation` TO 'admin';
-- GRANT SELECT ON `sde`.`VueListeEnseignements` TO 'admin';
-- Donner les droits d'exécution sur les procédures
GRANT EXECUTE ON PROCEDURE `sde`.`InsererEnseignement` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierEnseignant` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierService` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererFormation` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierEnseignement` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`SupprimerService` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererEnseignant` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`InsererService` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierFormation` TO 'admin';
