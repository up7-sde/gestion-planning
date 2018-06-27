/******************************************************/
-- Contenu du script :
-- Creation de la base et des tables
-- Création des utilisateur (admin et enseingant)
-- Création des Vue
-- Création des Procédures
-- Attribution des droits
-- Inserts dans les tables
/******************************************************/


/******************************************************/
-- Schema sde
/******************************************************/
DROP SCHEMA IF EXISTS `sde` ;

/******************************************************/
-- Schema sde (avec un encodage en utf8)
/******************************************************/
CREATE SCHEMA IF NOT EXISTS `sde` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci ;
USE `sde` ;

/******************************************************/
-- Table `sde`.`Statut`
/******************************************************/
DROP TABLE IF EXISTS `sde`.`Statut` ;

CREATE TABLE `sde`.`Statut` (
  `idStatut` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `heureService` INT NOT NULL,
  `titulaire` TINYINT NOT NULL,
  PRIMARY KEY (`idStatut`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nom_UNIQUE` ON `sde`.`Statut` (`nom` ASC);


/******************************************************/
-- Table `sde`.`Enseignant`
/******************************************************/
DROP TABLE IF EXISTS `sde`.`Enseignant` ;

CREATE TABLE `sde`.`Enseignant` (
  `idEnseignant` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `prenom` VARCHAR(45) NOT NULL,
  `depEco` TINYINT NOT NULL,
  `Statut_idStatut` INT NOT NULL,
  PRIMARY KEY (`idEnseignant`),
  CONSTRAINT `fk_Enseignant_Statut`
    FOREIGN KEY (`Statut_idStatut`)
    REFERENCES `sde`.`Statut` (`idStatut`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Enseignant_Statut` ON `sde`.`Enseignant` (`Statut_idStatut` ASC);


/******************************************************/
-- Table `sde`.`TypeService`
/******************************************************/
DROP TABLE IF EXISTS `sde`.`TypeService` ;

CREATE TABLE `sde`.`TypeService` (
  `idTypeService` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `poids` FLOAT NOT NULL DEFAULT 1.0,
  PRIMARY KEY (`idTypeService`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nom_UNIQUE` ON `sde`.`TypeService` (`nom` ASC);


/******************************************************/
-- Table `sde`.`Enseignement`
/******************************************************/
DROP TABLE IF EXISTS `sde`.`Enseignement` ;

CREATE TABLE `sde`.`Enseignement` (
  `apogee` VARCHAR(45) NOT NULL,
  `intitule` VARCHAR(45) NOT NULL,
  `heureCM` INT NOT NULL,
  `heureTP` INT NOT NULL,
  `semestre` INT NOT NULL,
  `nbGroupes` INT NOT NULL,
  PRIMARY KEY (`apogee`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `apogee_UNIQUE` ON `sde`.`Enseignement` (`apogee` ASC);


/******************************************************/
-- Table `sde`.`Service`
-- Annee du cours pour pouvoir tenir l'historique des cours d'anéne en année
-- Le champs Enseignement_apogee peut-être vide dans le cas des services qui ne sont pas des cours
/******************************************************/
DROP TABLE IF EXISTS `sde`.`Service` ;

CREATE TABLE `sde`.`Service` (
  `idService` INT NOT NULL AUTO_INCREMENT,
  `Enseignant_idEnseignant` INT NOT NULL,
  `TypeService_idTypeService` INT NOT NULL,
  `annee` INT NOT NULL,
  `Enseignement_apogee` VARCHAR(45) NULL,
  `commentaire` VARCHAR(100) NULL,
  `nbHeures` INT NOT NULL,
  PRIMARY KEY (`idService`),
  CONSTRAINT `fk_Service_Enseignant`
    FOREIGN KEY (`Enseignant_idEnseignant`)
    REFERENCES `sde`.`Enseignant` (`idEnseignant`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Service_TypeService`
    FOREIGN KEY (`TypeService_idTypeService`)
    REFERENCES `sde`.`TypeService` (`idTypeService`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Service_Enseignement`
    FOREIGN KEY (`Enseignement_apogee`)
    REFERENCES `sde`.`Enseignement` (`apogee`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_Service_Enseignant_id` ON `sde`.`Service` (`Enseignant_idEnseignant` ASC);

CREATE INDEX `fk_Service_TypeService_id` ON `sde`.`Service` (`TypeService_idTypeService` ASC);

CREATE INDEX `fk_Service_Enseignement_id` ON `sde`.`Service` (`Enseignement_apogee` ASC);


/******************************************************/
-- Table `sde`.`Diplome`
/******************************************************/
DROP TABLE IF EXISTS `sde`.`Diplome` ;

CREATE TABLE `sde`.`Diplome` (
  `idDiplome` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idDiplome`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nom_UNIQUE` ON `sde`.`Diplome` (`nom` ASC);


/******************************************************/
-- Table `sde`.`Formation`
/******************************************************/
DROP TABLE IF EXISTS `sde`.`Formation` ;

CREATE TABLE `sde`.`Formation` (
  `idFormation` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `Diplome_idDiplome` INT NOT NULL,
  PRIMARY KEY (`idFormation`),
  CONSTRAINT `fk_Formation_Diplome`
    FOREIGN KEY (`Diplome_idDiplome`)
    REFERENCES `sde`.`Diplome` (`idDiplome`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Formation_Diplomes_id` ON `sde`.`Formation` (`Diplome_idDiplome` ASC);

CREATE UNIQUE INDEX `nom_UNIQUE` ON `sde`.`Formation` (`nom` ASC);


/******************************************************/
-- Table `sde`.`EnseignementFormation`
/******************************************************/
DROP TABLE IF EXISTS `sde`.`EnseignementFormation` ;

CREATE TABLE `sde`.`EnseignementFormation` (
  `Formation_idFormation` INT NOT NULL AUTO_INCREMENT,
  `Enseignement_apogee` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Formation_idFormation`, `Enseignement_apogee`),
  CONSTRAINT `fk_EnseignementFormation_Formation`
    FOREIGN KEY (`Formation_idFormation`)
    REFERENCES `sde`.`Formation` (`idFormation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EnseignementFormation_Enseignement`
    FOREIGN KEY (`Enseignement_apogee`)
    REFERENCES `sde`.`Enseignement` (`apogee`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_EnseignementFormation_Formation_id` ON `sde`.`EnseignementFormation` (`Formation_idFormation` ASC);

CREATE INDEX `fk_EnseignementFormation_Enseignement_id` ON `sde`.`EnseignementFormation` (`Enseignement_apogee` ASC);


/******************************************************/
-- Table `sde`.`Utilisateur`
--  le mdp de longueure 60 correspondant à l'output de la fonction password_hash de php
-- les champs XXColor permettront de personnaliser l'affichage de chaque utilisateur
-- authLevel permettra de distinguer le compte admin des comtpes enseignants (admin ou pas)
/******************************************************/
DROP TABLE IF EXISTS `sde`.`Utilisateur` ;

CREATE TABLE `sde`.`Utilisateur`(
  `idUtilisateur` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `mdp` VARCHAR(60) NOT NULL,
  `bckColor` VARCHAR(45) NOT NULL,
  `headerColor` VARCHAR(45) NOT NULL,
  `authLevel` TINYINT NOT NULL,
  PRIMARY KEY (`idUtilisateur`))
ENGINE = InnoDB;

/******************************************************/
/**************** CREER LES PROCEDURES ****************/
/******************************************************/

/******************************************************/
-- procedure InsererUtilisateur
-- A utiliser par le compte admin pour créer un utilisateur
/******************************************************/

DROP procedure IF EXISTS `sde`.`InsererUtilisateur`;

DELIMITER $$

CREATE PROCEDURE `InsererUtilisateur` (IN p_nom VARCHAR(45),IN p_email VARCHAR(45), IN p_mdp VARCHAR(60), IN p_bckColor VARCHAR(45), IN p_headerColor VARCHAR(45), IN p_authLevel TINYINT)
BEGIN
	INSERT INTO `sde`.`Utilisateur` (nom, email, authLevel, mdp, bckColor, headerColor)
    VALUES (UPPER(p_nom), UPPER(p_email), p_authLevel, p_mdp, p_bckColor, p_headerColor);
END;$$
DELIMITER ;

/******************************************************/
-- procedure SupprimerUtilisateur
/******************************************************/

DROP procedure IF EXISTS `sde`.`SupprimerUtilisateur`;

DELIMITER $$

CREATE PROCEDURE `SupprimerUtilisateur` (IN p_idUtilisateur INT)
BEGIN
    DELETE FROM `sde`.`Utilisateur` WHERE idUtilisateur = p_idUtilisateur;
END;$$
DELIMITER ;

/******************************************************/
-- procedure ModifierUtilisateur
-- A utiliser par le compte enseignant pour modifier ses infos (mais pas son authLevel)
/******************************************************/

DROP procedure IF EXISTS `sde`.`ModifierUtilisateur`;

DELIMITER $$

CREATE PROCEDURE `ModifierUtilisateur` (IN p_idUtilisateur INT, IN p_nom VARCHAR(45),IN p_email VARCHAR(45), IN p_mdp VARCHAR(60), IN p_bckColor VARCHAR(45), IN p_headerColor VARCHAR(45))
BEGIN
	UPDATE `sde`.`Utilisateur`
    SET
		nom = UPPER(p_nom),
        email = UPPER(p_email),
        mdp = p_mdp,
        bckColor = p_bckColor,
        headerColor = p_headerColor
	WHERE
		idUtilisateur = p_idUtilisateur;
END;$$
DELIMITER ;

/******************************************************/
-- procedure InsererEnseignement
/******************************************************/

DROP procedure IF EXISTS `sde`.`InsererEnseignement`;

DELIMITER $$

CREATE PROCEDURE InsererEnseignement(IN p_apogee VARCHAR(45), IN p_intitule VARCHAR(45), IN p_heureCM INT, IN p_heureTP INT, IN p_semestre INT, IN p_nbGroupes INT, IN p_idFormation INT)
BEGIN
    -- Ajouter l'enseignement
	INSERT INTO `sde`.`Enseignement` (apogee, intitule, heureCM, heureTP, semestre, nbGroupes)
	VALUES (UPPER(p_apogee), UPPER(p_intitule), p_heureCM, p_heureTP, p_semestre, p_nbGroupes);
	-- Ajouter l'entrée dans la table de liaison EnseignementsFormations
    INSERT INTO `sde`.`EnseignementFormation` (Formation_idFormation, Enseignement_apogee)
    VALUES (p_idFormation, p_apogee);
END;$$

DELIMITER ;

/******************************************************/
-- procedure InsererService
/******************************************************/

DROP procedure IF EXISTS `sde`.`InsererService`;

DELIMITER $$

CREATE PROCEDURE `InsererService` (IN p_idEnseignant INT, IN p_idTypeService INT, IN p_annee INT, IN p_apogee VARCHAR(45), IN p_nbHeures INT, IN p_commentaire VARCHAR(100))
BEGIN
    -- Insérer le nouveau service
	INSERT INTO `sde`.`Service` (Enseignant_idEnseignant, TypeService_idTypeService, annee, Enseignement_apogee, nbHeures, commentaire)
	VALUES (p_idEnseignant, p_idTypeService, p_annee, UPPER(p_apogee), p_nbHeures, p_commentaire);
END;$$

DELIMITER ;

/******************************************************/
-- procedure InsererFormation
/******************************************************/

DROP procedure IF EXISTS `sde`.`InsererFormation`;

DELIMITER $$

CREATE PROCEDURE `InsererFormation` (IN p_nom VARCHAR(45), IN p_idDiplome INT)
BEGIN
	INSERT INTO `sde`.`Formation` (nom, Diplome_idDiplome)
	VALUES (UPPER(p_nom), p_idDiplome);
END;$$

DELIMITER ;


/******************************************************/
-- procedure ModifierEnseignant
/******************************************************/

DROP procedure IF EXISTS `sde`.`ModifierEnseignant`;

DELIMITER $$

CREATE PROCEDURE `ModifierEnseignant` (IN p_idEnseignant INT, IN p_nom VARCHAR(45), IN p_prenom VARCHAR(45), IN p_idStatut INT, IN p_depEco TINYINT)
BEGIN
	UPDATE `sde`.`Enseignant`
    SET
		nom = UPPER(p_nom),
        prenom = UPPER(p_prenom),
        Statut_idStatut = p_idStatut,
        depEco = p_depEco
	WHERE
		idEnseignant = p_idEnseignant;
END;$$

DELIMITER ;

/******************************************************/
-- procedure ModifierService
/******************************************************/

DROP procedure IF EXISTS `sde`.`ModifierService`;

DELIMITER $$

CREATE PROCEDURE `ModifierService` (IN p_idService INT, IN p_idEnseignant INT, IN p_idTypeService INT, IN p_annee INT, IN p_apogee VARCHAR(45), IN p_nbHeures INT, IN p_commentaire VARCHAR(100))
BEGIN
    -- Effectuer la modification
    UPDATE `sde`.`Service`
	SET
		Enseignant_idEnseignant = p_idEnseignant,
		TypeService_idTypeService = p_idTypeService,
		annee = p_annee,
		Enseignement_apogee = p_apogee,
		nbHeures = p_nbHeures,
        commentaire = p_commentaire
	WHERE
		idService = p_idService;
END;$$

DELIMITER ;

/******************************************************/
-- procedure ModifierEnseignement
/******************************************************/

DROP procedure IF EXISTS `sde`.`ModifierEnseignement`;

DELIMITER $$

CREATE PROCEDURE `ModifierEnseignement` (IN p_apogeeOri VARCHAR(45), IN p_apogee VARCHAR(45), IN p_intitule VARCHAR(45), IN p_heureCM INT, IN p_heureTP INT, IN p_semestre INT, IN p_nbGroupes INT, IN p_idFormation INT)
BEGIN

	-- Mettre à jour l'Enseignement
	UPDATE `sde`.`Enseignement`
    SET
		apogee = UPPER(p_apogee),
        intitule = UPPER(p_intitule),
        heureCM = p_heureCM,
        heureTP = p_heureTP,
        semestre = p_semestre,
        nbGroupes = p_nbGroupes
	WHERE
		apogee = p_apogeeOri;

	-- Mettre à jour la table de liaison EnseignementsFormations
    UPDATE `sde`.`EnseignementFormation`
    SET
		Formation_idFormation = p_idFormation,
		Enseignement_apogee = p_apogee
    WHERE
		Enseignement_apogee = p_apogeeOri;
END;$$

DELIMITER ;

/******************************************************/
-- procedure ModifierFormation
/******************************************************/

DROP procedure IF EXISTS `sde`.`ModifierFormation`;

DELIMITER $$

CREATE PROCEDURE `ModifierFormation` (IN p_idFormation INT, IN p_nom VARCHAR(45), IN p_idDiplome INT)
BEGIN
	UPDATE `sde`.`Formation`
    SET
		nom = UPPER(p_nom),
		Diplome_idDiplome = p_idDiplome
    WHERE
		idFormation = p_idFormation;
END;$$

DELIMITER ;

/******************************************************/
-- procedure SupprimerService
/******************************************************/

DROP procedure IF EXISTS `sde`.`SupprimerService`;

DELIMITER $$

CREATE PROCEDURE `SupprimerService` (IN p_idService INT)
BEGIN
	DELETE FROM `sde`.`Service` WHERE idService = p_idService;
END;$$

DELIMITER ;

/******************************************************/
-- procedure InsererEnseignant
/******************************************************/

DROP procedure IF EXISTS `sde`.`InsererEnseignant`;

DELIMITER $$

CREATE PROCEDURE InsererEnseignant(IN p_nom VARCHAR(45), IN p_prenom VARCHAR(45), IN p_idStatut INT, IN p_depEco INT)
BEGIN
    INSERT INTO `sde`.`Enseignant` (nom, prenom, Statut_idStatut, depEco)
    VALUES (UPPER(p_nom), UPPER(p_prenom), p_idStatut, p_depEco);
END;$$

DELIMITER ;

/******************************************************/
-- procedure SupprimerFormation
/******************************************************/

DROP procedure IF EXISTS `sde`.`SupprimerFormation`;

DELIMITER $$

CREATE PROCEDURE `SupprimerFormation` (IN p_idFormation INT)
BEGIN
	DELETE FROM `sde`.`Formation` WHERE idFormation = p_idFormation;
END;$$

DELIMITER ;

/******************************************************/
-- procedure SupprimerEnseignement
/******************************************************/

DROP procedure IF EXISTS `sde`.`SupprimerEnseignement`;

DELIMITER $$

CREATE PROCEDURE `SupprimerEnseignement` (IN p_apogee VARCHAR(45))
BEGIN
	-- Supprimer l'enseignement
	DELETE FROM `sde`.`Enseignement` WHERE `apogee` = p_apogee;
    -- Suprimer l'entrée dans la table de liaison EnseignementFormation
    DELETE FROM `sde`.`EnseignementFormation` WHERE `Enseignement_apogee` = p_apogee;
END$$

DELIMITER ;

/******************************************************/
-- procedure SupprimerEnseignant
/******************************************************/

DROP procedure IF EXISTS `sde`.`SupprimerEnseignant`;

DELIMITER $$

CREATE PROCEDURE `SupprimerEnseignant` (IN p_idEnseignant INT)
BEGIN
	DELETE FROM `sde`.`Enseignant` WHERE `idEnseignant` = p_idEnseignant;
END$$

DELIMITER ;

/******************************************************/
-- procedure InsererDiplome
/******************************************************/

DROP procedure IF EXISTS `sde`.`InsererDiplome`;

DELIMITER $$

CREATE PROCEDURE `InsererDiplome` (IN p_nom VARCHAR(45))
BEGIN
	INSERT INTO `sde`.`Diplome` (nom) VALUES (UPPER(p_nom));
END$$

DELIMITER ;

/******************************************************/
-- procedure ModifierDiplome
/******************************************************/

DROP procedure IF EXISTS `sde`.`ModifierDiplome`;

DELIMITER $$

CREATE PROCEDURE `ModifierDiplome` (IN p_idDiplome INT, IN p_nom VARCHAR(45))
BEGIN
	UPDATE `sde`.`Diplome` SET nom = UPPER(p_nom) WHERE idDiplome = p_idDiplome;
END$$

DELIMITER ;

/******************************************************/
-- procedure SupprimerDiplome
/******************************************************/

DROP procedure IF EXISTS `sde`.`SupprimerDiplome`;

DELIMITER $$

CREATE PROCEDURE `SupprimerDiplome` (IN p_idDiplome INT)
BEGIN
	DELETE FROM `sde`.`Diplome` WHERE idDiplome = p_idDiplome;
END$$

DELIMITER ;

/******************************************************/
-- procedure InsererTypeService
/******************************************************/

DROP procedure IF EXISTS `sde`.`InsererTypeService`;

DELIMITER $$

CREATE PROCEDURE `InsererTypeService` (IN p_nom VARCHAR(45), IN p_poids FLOAT)
BEGIN
	INSERT INTO `sde`.`TypeService` (nom, poids) VALUES (UPPER(p_nom), p_poids);
END$$

DELIMITER ;

/******************************************************/
-- procedure ModifierTypeService
/******************************************************/

DROP procedure IF EXISTS `sde`.`ModifierTypeService`;

DELIMITER $$

CREATE PROCEDURE `ModifierTypeService` (IN p_idTypeService INT, IN p_nom VARCHAR(45), IN p_poids FLOAT)
BEGIN
	-- Vérifier qu'on ne touche pas au 2 premiers types (CM et TP)
    UPDATE `sde`.`TypeService` SET nom = UPPER(p_nom), poids = p_poids WHERE idTypeService = p_idTypeService;
END$$

DELIMITER ;

/******************************************************/
-- procedure SupprimerTypeService
/******************************************************/

DROP procedure IF EXISTS `sde`.`SupprimerTypeService`;

DELIMITER $$

CREATE PROCEDURE `SupprimerTypeService` (IN p_idTypeService INT)
BEGIN
	-- Empecher l'admin de supprimer les type de service 1 (CM) et 2 (TD)
	IF (p_idTypeService > 2)
    THEN
	DELETE FROM `sde`.`TypeService` WHERE idTypeService = p_idTypeService;
	END IF;
END$$

DELIMITER ;

/******************************************************/
-- procedure InsererStatut
/******************************************************/

DROP procedure IF EXISTS `sde`.`InsererStatut`;

DELIMITER $$

CREATE PROCEDURE `InsererStatut` (IN p_nom VARCHAR(45), IN p_heureService INT, IN p_titulaire TINYINT)
BEGIN
	INSERT INTO `sde`.`Statut` (nom, heureService, titulaire)
	VALUES (UPPER(p_nom), p_heureService, p_titulaire);
END;$$

DELIMITER ;

/******************************************************/
-- procedure ModifierStatut
/******************************************************/

DROP procedure IF EXISTS `sde`.`ModifierStatut`;

DELIMITER $$

CREATE PROCEDURE `ModifierStatut` (IN p_idStatut INT, IN p_nom VARCHAR(45), IN p_heureService INT, IN p_titulaire TINYINT)
BEGIN
	UPDATE `sde`.`Statut`
    SET
		nom = UPPER(p_nom),
        heureService = p_heureService,
        titulaire = p_titulaire
	WHERE
		idStatut = p_idStatut;
END;$$

DELIMITER ;

/******************************************************/
-- procedure SupprimerStatut
/******************************************************/

DROP procedure IF EXISTS `sde`.`SupprimerStatut`;

DELIMITER $$

CREATE PROCEDURE `SupprimerStatut` (IN p_idStatut INT)
BEGIN
	DELETE FROM `sde`.`Statut` WHERE idStatut = p_idStatut;
END$$

DELIMITER ;

/******************************************************/
-- procedure DuppliquerService
/******************************************************/

DROP procedure IF EXISTS `sde`.`DuppliquerService`;

DELIMITER $$

CREATE PROCEDURE `DuppliquerService` (IN p_anneeCible INT, IN p_anneeDest INT)
BEGIN
	-- Duppliquer les services d'une année à l'autre
    INSERT INTO `sde`.`Service` (annee, Enseignant_idEnseignant, TypeService_idTypeService, Enseignement_apogee, nbHeures)
    	SELECT p_anneeDest, Enseignant_idEnseignant, TypeService_idTypeService, Enseignement_apogee, nbHeures
		FROM `sde`.`Service`
		WHERE annee = p_anneeCible
	;
END$$

DELIMITER ;

/******************************************************/
/******************** CREER LES VUES ******************/
/******************************************************/

/******************************************************/
-- View `sde`.`VueListeEnseignant`
-- L'instruction COALESCE(SUM(`sde`.`TypeService`.`poids` * `sde`.`Service`.`nbHeures`), 0)
-- permet d'afficher l'enseignant même s'il n'a pas encore de service affecté (dans ce cas on 0 pour HeuresAffectees)
-- permet également de calculer le nombre d'heures affectées en fonction du poids d'un service (1.5 pour CM, 1 pour un TD, etc)
/******************************************************/
DROP VIEW IF EXISTS `sde`.`VueListeEnseignant` ;
CREATE VIEW VueListeEnseignant AS
SELECT
    `sde`.`Enseignant`.`idEnseignant` AS id,
    `sde`.`Enseignant`.`nom`,
    `sde`.`Enseignant`.`prenom`,
    IF(`sde`.`Enseignant`.`depEco`, "SDE", "Hors SDE") AS Departement,
    IF(`sde`.`Statut`.`titulaire`, "Titulaire", "Non-Titulaire") AS Tituaire,
    `sde`.`Statut`.`nom` AS Categorie,
    `sde`.`Statut`.`heureService` AS HeuresDues,
    COALESCE(SUM(`sde`.`TypeService`.`poids` * `sde`.`Service`.`nbHeures`), 0) AS HeuresAffectees
FROM
    `sde`.`Enseignant`
LEFT JOIN
    `sde`.`Service` ON `sde`.`Service`.`Enseignant_idEnseignant` = `sde`.`Enseignant`.`idEnseignant`
LEFT JOIN
    `sde`.`TypeService`ON `sde`.`TypeService`.`idTypeService` = `sde`.`Service`.`TypeService_idTypeService`
INNER JOIN
	`sde`.`Statut` ON `sde`.`Statut`.`idStatut` = `sde`.`Enseignant`.`Statut_idStatut`
GROUP BY
	`sde`.`Enseignant`.`idEnseignant`
;

/******************************************************/
-- View `sde`.`VueListeEnseignement`
/******************************************************/
DROP VIEW IF EXISTS `sde`.`VueListeEnseignement` ;
CREATE VIEW VueListeEnseignement AS
SELECT
    `sde`.`Enseignement`.`apogee` AS id,
    `sde`.`Enseignement`.`apogee` AS apogee2,
    `sde`.`Enseignement`.`intitule`,
    `sde`.`Enseignement`.`heureCM` AS heureCM,
    -- Calculer le nombre d'heure de service correspondant à l'enseignenment et au type CM
    SUM(IF(`sde`.`Service`.`TypeService_idTypeService` = 1,`sde`.`Service`.`nbHeures`, 0)) AS heureCMAffectee,
    `sde`.`Enseignement`.`heureTP` AS hTPparGroupe,
	`sde`.`Enseignement`.`nbGroupes` AS nbGroupe,
	`sde`.`Enseignement`.`heureTP` * `sde`.`Enseignement`.`nbGroupes` AS hTPtotal,
    -- Calculer le nombre d'heure de service correspondant à l'enseignenment et au type TD
	SUM(IF(`sde`.`Service`.`TypeService_idTypeService` = 2,`sde`.`Service`.`nbHeures`, 0)) AS heureTPAffectee,
    `sde`.`Enseignement`.`semestre`,
    `sde`.`Formation`.`nom` AS formation,
    `sde`.`Formation`.`idFormation` as idFormation,
    `sde`.`Diplome`.`nom` AS diplome
FROM
	`sde`.`Enseignement`
LEFT JOIN
    `sde`.`Service` ON  `sde`.`Service`.`Enseignement_apogee` = `sde`.`Enseignement`.`apogee`
INNER JOIN
    `sde`.`EnseignementFormation` ON `sde`.`EnseignementFormation`.`Enseignement_apogee` = `sde`.`Enseignement`.`apogee`
INNER JOIN
    `sde`.`Formation` ON `sde`.`Formation`.`idFormation` = `sde`.`EnseignementFormation`.`Formation_idFormation`
INNER JOIN
  	`sde`.`Diplome` ON `sde`.`Diplome`.`idDiplome` = `sde`.`Formation`.`Diplome_idDiplome`
GROUP BY `sde`.`Enseignement`.`apogee`
;

/******************************************************/
-- View `sde`.`VueListeService`
/******************************************************/
DROP VIEW IF EXISTS `sde`.`VueListeService` ;
CREATE VIEW VueListeService AS
SELECT
	`sde`.`Service`.`idService` as id,
    `sde`.`Enseignement`.`apogee`,
    `sde`.`Enseignement`.`intitule`,
    `sde`.`TypeService`.`nom` AS type,
    `sde`.`Service`.`nbHeures` as heure,
    `sde`.`Service`.`annee` AS annee,
    `sde`.`Enseignant`.`idEnseignant`,
    `sde`.`Enseignant`.`nom`,
    `sde`.`Enseignant`.`prenom`,
	`sde`.`Formation`.`nom` AS formation,
    `sde`.`Diplome`.`nom` AS diplome,
    `sde`.`Service`.`commentaire`
FROM
    `sde`.`Service`
LEFT JOIN
    `sde`.`Enseignement` ON `sde`.`Enseignement`.`apogee` = `sde`.`Service`.`Enseignement_apogee`
LEFT JOIN
	`EnseignementFormation` ON `EnseignementFormation`.`Enseignement_apogee` = `Enseignement`.`apogee`
LEFT JOIN
	`Formation` ON `Formation`.`idFormation` = `EnseignementFormation`.`Formation_idFormation`
LEFT JOIN
	`Diplome` ON `Diplome`.`idDiplome` = `Formation`.`Diplome_idDiplome`
INNER JOIN
    `sde`.`TypeService` ON `sde`.`TypeService`.`idTypeService` = `sde`.`Service`.`TypeService_idTypeService`
INNER JOIN
    `sde`.`Enseignant` ON `sde`.`Enseignant`.`idEnseignant` = `sde`.`Service`.`Enseignant_idEnseignant`
;

/******************************************************/
-- View `sde`.`VueListeFormation`
-- COALESCE permet d'afficher 0 si
-- - aucun service n'est affecté à une formation (pour heureCMAffectee et heureTPAffectee)
-- - il existe une formation avec 0 heure de TP ou 0 heure de CM (pour heureCM et heureTP)
/******************************************************/
DROP VIEW IF EXISTS `sde`.`VueListeFormation` ;
CREATE VIEW `VueListeFormation` AS
SELECT
    `sde`.`VueListeEnseignement`.`idFormation` AS id,
    `sde`.`VueListeEnseignement`.`diplome`,
	`sde`.`VueListeEnseignement`.`formation`,
    COALESCE(SUM(heureCM), 0) AS heureCM,
    COALESCE(SUM(heureCMAffectee),0) AS heureCMAffectee,
	COALESCE(SUM(hTPtotal),0) AS heureTP,
    COALESCE(SUM(heureTPAffectee),0) AS heureTPAffectee
-- Basé sur la vue des enseignements
FROM `sde`.`VueListeEnseignement`
GROUP BY `sde`.`VueListeEnseignement`.`idFormation`;

DROP VIEW IF EXISTS `sde`.`VueListeDiplome` ;

CREATE VIEW `VueListeDiplome` AS
SELECT
    `sde`.`Diplome`.`idDiplome` AS id,
    `sde`.`Diplome`.`nom`
FROM `sde`.`Diplome`;

DROP VIEW IF EXISTS `sde`.`VueListeStatut` ;
CREATE VIEW `VueListeStatut` AS
SELECT
    `sde`.`Statut`.`idStatut` AS id,
    `sde`.`Statut`.`nom`,
    `sde`.`Statut`.`heureService`,
    `sde`.`Statut`.`titulaire`
FROM `sde`.`Statut`;

DROP VIEW IF EXISTS `sde`.`VueListeType` ;
CREATE VIEW `VueListeType` AS
SELECT
    `sde`.`TypeService`.`idTypeService` AS id,
    `sde`.`TypeService`.`nom`,
    `sde`.`TypeService`.`poids`
FROM `sde`.`TypeService`;

/******************************************************/
-- View `sde`.`VueLabelEnseignant`
/******************************************************/
DROP VIEW IF EXISTS `sde`.`VueLabelEnseignant` ;
CREATE VIEW `VueLabelEnseignant` AS
SELECT
	`sde`.`Enseignant`.`idEnseignant` AS id,
	CONCAT(`sde`.`Enseignant`.`nom`, " ", `sde`.`Enseignant`.`prenom`) AS nom
FROM
	`sde`.`Enseignant`;

/******************************************************/
-- View `sde`.`VueLabelEnseignement`
/******************************************************/
DROP VIEW IF EXISTS `sde`.`VueLabelEnseignement` ;
CREATE VIEW `VueLabelEnseignement` AS
SELECT
	`sde`.`Enseignement`.`apogee` as id,
	`sde`.`Enseignement`.`intitule`as nom
FROM
	`sde`.`Enseignement`;

/******************************************************/
-- View `sde`.`VueLabelFormation`
/******************************************************/
DROP VIEW IF EXISTS `sde`.`VueLabelFormation` ;
CREATE VIEW `VueLabelFormation` AS
SELECT
	`sde`.`Formation`.`idFormation` as id,
	`sde`.`Formation`.`nom` as nom
FROM
	`sde`.`Formation`;

/******************************************************/
-- View `sde`.`VueLabelDiplome`
/******************************************************/
DROP VIEW IF EXISTS `sde`.`VueLabelDiplome` ;
CREATE VIEW `VueLabelDiplome` AS
SELECT
	`sde`.`Diplome`.`idDiplome` as id,
	`sde`.`Diplome`.`nom` as nom
FROM
	`sde`.`Diplome`;

/******************************************************/
-- View `sde`.`VueLabelStatut`
/******************************************************/
DROP VIEW IF EXISTS `sde`.`VueLabelStatut` ;
CREATE VIEW `VueLabelStatut` AS
SELECT
	`sde`.`Statut`.`idStatut` as id,
	`sde`.`Statut`.`nom`
FROM
	`sde`.`Statut`;

/******************************************************/
-- View `sde`.`VueLabelTypeService`
/******************************************************/
DROP VIEW IF EXISTS `sde`.`VueLabelTypeService` ;
CREATE VIEW `VueLabelTypeService` AS
SELECT
	`sde`.`TypeService`.`idTypeService` as id,
	`sde`.`TypeService`.`nom`
FROM
	`sde`.`TypeService`;
SET SQL_MODE = '';
GRANT USAGE ON *.* TO admin;
 DROP USER admin;
SET SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
CREATE USER 'admin' IDENTIFIED BY 'mdpadmin';

SET SQL_MODE = '';
GRANT USAGE ON *.* TO enseignant;
 DROP USER enseignant;
SET SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
CREATE USER 'enseignant' IDENTIFIED BY 'mdpenseignant';

/******************************************************/
/****************** AJOUT DES DROITS ******************/
/******************************************************/

-- Donner les droits sur les vues aux comptes enseignant et admin
GRANT SELECT ON `sde`.* TO 'enseignant';
GRANT SELECT ON `sde`.* TO 'admin';

-- Donner les droits d'exécution sur les procédures à l'admin
GRANT EXECUTE ON PROCEDURE `sde`.`ModifierUtilisateur` TO 'enseignant';

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
GRANT EXECUTE ON PROCEDURE `sde`.`InsererUtilisateur` TO 'admin';
GRANT EXECUTE ON PROCEDURE `sde`.`SupprimerUtilisateur` TO 'admin';

/******************************************************/
/****************** REMPLIR LES TABLES ****************/
/******************************************************/
USE `sde`;

/******************************************************/
-- Table`sde`.`Enseignement`
/******************************************************/
INSERT INTO `sde`.`Enseignement` (`apogee`, `intitule`, `heureCM`, `heureTP`, `semestre`, `nbGroupes`)
VALUES
    ('54AEE2EC', 'HIST. DES FAITS ÉCO.', 26, 18, 1, 7),
    ('54AEE5EC', 'MISE À NIVEAU EN MATHÉMATIQUES', 24, 18, 1, 2),
    ('54AEE6EC', 'MÉTHODO. UNIVERS. PP1', 24, 18, 1, 4),
    ('54AED3EC', 'INTRODUCTION AU DROIT', 24, 0, 1, 0),
    ('54BEE4EC', 'COMP. GESTION GÉNÉRALE', 24, 18, 2, 3),
    ('54BEE2EC', 'ÉCONOMIE DESCRIPTIVE', 26, 18, 2, 3),
    ('54BEE3EC', 'ÉCONOMIE EUROP.', 26, 18, 2, 3),
    ('54BEM1EC', 'MACROÉCO. APPLIQUÉE', 26, 18, 2, 3),
    ('55BEE5EC', 'MATHS POUR SCIENCES SOCIALES', 26, 18, 2, 3),
    ('54BEE1EC', 'ANALYSE MICROÉCO', 0, 18, 2, 6),
    ('54BEE6EC', 'MÉTHODO. UNIVERS. PP2', 0, 18, 2, 3),
    ('54DEE3EC', 'ÉCO DE L\'ENTREPRISE', 26, 18, 3, 3),
    ('54DEE6EC', 'STAT. INFORMATIQUE (1)', 13, 30, 3, 4),
    ('54DEE2EC', 'HIST DE LA PENSÉE ÉCO', 0, 18, 3, 5),
    ('54DEE1EC', 'ANALYSE MACROÉCO', 0, 18, 3, 5),
    ('54DEE4EC', 'SOCIO-ÉCO DES ORG.', 26, 18, 3, 3),
    ('54DEE5EC', 'MATHS POUR SCIENCES SOCIALES', 24, 18, 3, 2),
    ('54EEE5EC', 'STAT. INFORMATIQUE (2)', 24, 18, 4, 3),
    ('54EEE1EC', 'ECO DU TRAVAIL', 0, 18, 4, 5),
    ('54EEE2EC', 'THÉORIE DE LA  MONNAIE', 0, 18, 4, 4),
    ('54EEE3EC', 'POLITIQUE ÉCO. (1)', 26, 18, 4, 3),
    ('54EED4EC', 'DROIT DES CONTRATS', 36, 0, 4, 1),
    ('43GU01ES', 'SOCIO. DES SERVICES', 26, 18, 5, 2),
    ('43GU02ES', 'ÉCO INDUSTRIELLE', 26, 18, 5, 2),
    ('43GU03ES', '1 SOCIALE', 26, 0, 5, 0),
    ('43GU11ES', 'THÉORIE DE LA CROISSANCE', 0, 18, 5, 4),
    ('43GU12ES', 'ÉCO INTERNATIONALE', 0, 18, 5, 4),
    ('43GU13ES', 'MARKETING', 26, 18, 5, 1),
    ('43GU21ES', 'GESTION RESS. HUM', 26, 18, 5, 1),
    ('43GU22ES', 'ANALYSE ECO MONDIALISATION', 26, 18, 5, 1),
    ('43GU23ES', 'EMPLOI ET FLEXIBILITÉ', 26, 18, 5, 1),
    ('43HU01ES', 'SOCIOLOGIE ÉCONOMIQUE', 26, 18, 6, 1),
    ('43HU02ES', 'ECO. DE L\'ENVIRONNT', 26, 18, 6, 2),
    ('43HU11ES', 'MONNAIE, BANQUE, FINANCE', 0, 18, 6, 4),
    ('43HU13ES', 'STAT. ET ÉCONOMÉTRIE', 26, 18, 6, 2),
    ('43HU14ES', 'COMPTABILITÉ ANALYTIQUE', 24, 18, 6, 1),
    ('43HU22ES', 'RELATIONS PROF EN EUROPE', 26, 18, 6, 0),
    ('43HU23ES', 'DROIT DU TRAVAIL', 24, 18, 6, 1),
    ('43HU21ES', 'ECO PROTECT. SOCIALE', 26, 18, 6, 1),
    ('43ME11MC', 'NOUVEAU RÉGIME DE CROISSANCE', 18, 0, 7, 0),
    ('44ME12MC', 'TENDANCES SOCIÉTALES', 18, 0, 7, 0),
    ('43ME13MC', 'ENJEUX SPATIAUX ', 18, 0, 7, 0),
    ('43ME22MC', 'ANALYSE DES DONNÉES ', 0, 30, 7, 1),
    ('43ME43MC', 'CONJONCT. ET PRÉVISION', 24, 12, 7, 1),
    ('43ME44MC', 'ORGANISATIONS ET INSTITUTIONS', 24, 12, 7, 1),
    ('43ME45MC', 'SOCIO-ÉCONOMIE DE LA CONSO', 24, 12, 7, 1),
    ('43ME46MC', 'MANAGEMENT STRATÉGIQUE', 24, 12, 7, 1),
    ('43ME41MC', 'ANALYSE DES DONNÉES ', 24, 36, 7, 1),
    ('43ME27MC', 'STAT-INFO  SPSS', 12, 24, 7, 0),
    ('43NE61MC', 'ACTIVITÉS ET TERRITOIRES', 24, 0, 8, 0),
    ('43NE63MC', 'INÉGALITÉ ET DÉVELOPPEMENT', 24, 0, 8, 0),
    ('43NE64MC', 'DÉVELOPPEMENT DURABLE', 24, 0, 8, 0),
    ('43ME65MC', 'HISTOIRE PENSÉE ÉCO. APRÈS KEYNES', 24, 0, 8, 0),
    ('43NE62MC', 'SYSTÈME D\'INFO ET ENTREPRISE', 24, 0, 8, 0),
    ('44NE06MC', 'MÉTHODES QUALI.: ENQUÊTE ET ENTRETIEN', 12, 24, 8, 4),
    ('78NE03AN', 'ANGLAIS', 0, 24, 8, 2),
    ('43NE07MC', 'ANALYSE FIN. DE L\'ENTREPRISE', 24, 12, 8, 1),
    ('43NE08MC', 'MARKETING', 24, 12, 8, 1),
    ('43NE09MC', 'SOCIOLOGIE DE L\'OPINION', 24, 12, 8, 1),
    ('43NE10MC', 'ÉCONOMIE DES RESS. HUMAINES', 24, 12, 8, 1),
    ('43NE11MC', 'SOCIOLOGIE DU TRAVAIL', 24, 12, 8, 1),
    ('43NE12MC', 'AUDIT SOCIAL', 16, 18, 8, 1),
    ('43PE02E1', 'PRÉSENTATION ORALE', 0, 13, 9, 2),
    ('43PE03E1', 'CONDUITE DE PROJETS', 14, 0, 9, 0),
    ('43PE04E1', 'APPROCHE DE L\'OPINION PUBLIQUE ', 8, 0, 9, 0),
    ('43PE05E1', 'TECH. D\'ENQUÊTES QUALITATIVES', 13, 13, 9, 1),
    ('43PE06E1', 'MÉTHODES QUANTITATIVES', 12, 0, 9, 0),
    ('43QE2043', 'DIAGNOS. STRATÉGIQUE', 24, 0, 9, 0),
    ('43PE30E1', 'PROSPECTIVE', 18, 6, 9, 1),
    ('43PU05E1', 'ANGLAIS', 12, 12, 9, 1),
    ('43PE08E1', 'GESTION DE L\'INFORMATION ', 14, 0, 9, 0),
    ('43PE10E1', 'MÉTHODOLOGIE DES ÉTUDES', 12, 0, 9, 0),
    ('43PE11E1', 'MÉTHODOLOGIE DE L\'INTERVENTION', 10, 0, 9, 0),
    ('43PE12E1', 'BUREAUTIQUE WORD_EXCEL', 12, 12, 9, 2),
    ('43PE09E1', 'MÉTHODOLOGIE DE LA RECHERCHE', 6, 0, 9, 0),
    ('43QE1343', 'ECONOMIE DE LA CONNAISSANCE', 20, 0, 10, 0),
    ('43QE1443', 'ECONOMIE SERVICIELLE ', 20, 0, 10, 0),
    ('43QE1543', 'MONDIALISATION', 20, 0, 10, 0),
    ('43QE1643', 'MUTAT. DU SYST. PROD.', 20, 0, 10, 0),
    ('43QE1843', 'MESURE DE LA PERFORMANCE MARKETING', 18, 0, 10, 0),
    ('43QE1943', 'APPROCHES DIGITALES DES ÉTUDES MARKETING', 18, 0, 10, 0),
    ('43QE2243', 'ANALYSE DES TISSUS ÉCONOMIQUES LOCAUX', 24, 0, 10, 0),
    ('43QE2143', 'ANALYSE SECTORIELLE', 24, 0, 10, 0),
    ('43QE24E1', 'ANALYSE DES EMPLOIS', 24, 0, 10, 0),
    ('43QE25E1', 'CONDUITE DU CHANGT', 24, 0, 10, 0),
    ('43QE26E1', 'SOCIOLOGIE DES ORGANISATIONS', 24, 0, 10, 0),
    ('43QE27E1', 'PROBLÉM. DE LA PERFORM.', 24, 0, 10, 0),
    ('43QE29E1', 'GESTION DE LA RELATION CLIENT', 24, 0, 10, 0),
    ('43U2DE53', '1 SPATIALE ET TERRITOIRE', 15, 0, 9, 0),
    ('43IF5044', 'STRATÉGIE D\'ENTREPRISE ET SYSTÈME D\'INFO', 27, 0, 9, 0),
    ('43IF5073', 'ALGORITHMIQUE', 48, 0, 9, 0),
    ('43IF5084', 'C#', 40, 0, 10, 0);

/******************************************************/
-- Table`sde`.`Diplome`
/******************************************************/
INSERT INTO `sde`.`Diplome` (`idDiplome`, `nom`) VALUES (1, 'LICENCE');
INSERT INTO `sde`.`Diplome` (`idDiplome`, `nom`) VALUES (2, 'MASTER');

/******************************************************/
-- Table`sde`.`Formation`
/******************************************************/
INSERT INTO `sde`.`Formation` (`idFormation`, `nom`, `Diplome_idDiplome`)
VALUES
    (1, 'ECONOMIE', 1),
    (2, 'MIASH', 2),
    (3, 'MECI', 2),
    (4, 'CCESE', 2),
    (5, 'IADL', 2),
    (6, 'PISE', 2),
    (7, 'E2S', 2),
    (8, 'EPOG', 2),
    (9, 'APE', 2);

/******************************************************/
-- Table`sde`.`EnseignementFormation`
/******************************************************/
INSERT INTO `sde`.`EnseignementFormation` (`Formation_idFormation`, `Enseignement_apogee`)
VALUES
    (2, '54AEE2EC'),
    (1, '54AEE5EC'),
    (1, '54AEE6EC'),
    (1, '54AED3EC'),
    (1, '54BEE4EC'),
    (1, '54BEE2EC'),
    (1, '54BEE3EC'),
    (2, '54BEM1EC'),
    (1, '55BEE5EC'),
    (2, '54BEE1EC'),
    (1, '54BEE6EC'),
    (1, '54DEE3EC'),
    (1, '54DEE6EC'),
    (2, '54DEE2EC'),
    (2, '54DEE1EC'),
    (1, '54DEE4EC'),
    (1, '54DEE5EC'),
    (1, '54EEE5EC'),
    (2, '54EEE1EC'),
    (2, '54EEE2EC'),
    (1, '54EEE3EC'),
    (1, '54EED4EC'),
    (1, '43GU01ES'),
    (1, '43GU02ES'),
    (1, '43GU03ES'),
    (2, '43GU11ES'),
    (2, '43GU12ES'),
    (1, '43GU13ES'),
    (1, '43GU21ES'),
    (1, '43GU22ES'),
    (1, '43GU23ES'),
    (1, '43HU01ES'),
    (1, '43HU02ES'),
    (2, '43HU11ES'),
    (1, '43HU13ES'),
    (1, '43HU14ES'),
    (1, '43HU22ES'),
    (1, '43HU23ES'),
    (1, '43HU21ES'),
    (3, '43ME11MC'),
    (3, '44ME12MC'),
    (3, '43ME13MC'),
    (3, '43ME22MC'),
    (3, '43ME43MC'),
    (3, '43ME44MC'),
    (3, '43ME45MC'),
    (3, '43ME46MC'),
    (3, '43ME41MC'),
    (3, '43ME27MC'),
    (3, '43NE61MC'),
    (3, '43NE63MC'),
    (3, '43NE64MC'),
    (3, '43ME65MC'),
    (3, '43NE62MC'),
    (3, '44NE06MC'),
    (3, '78NE03AN'),
    (3, '43NE07MC'),
    (3, '43NE08MC'),
    (3, '43NE09MC'),
    (3, '43NE10MC'),
    (3, '43NE11MC'),
    (3, '43NE12MC'),
    (4, '43PE02E1'),
    (4, '43PE03E1'),
    (4, '43PE04E1'),
    (4, '43PE05E1'),
    (4, '43PE06E1'),
    (4, '43QE2043'),
    (4, '43PE30E1'),
    (4, '43PU05E1'),
    (4, '43PE08E1'),
    (4, '43PE10E1'),
    (4, '43PE11E1'),
    (4, '43PE12E1'),
    (4, '43PE09E1'),
    (4, '43QE1343'),
    (4, '43QE1443'),
    (4, '43QE1543'),
    (4, '43QE1643'),
    (4, '43QE1843'),
    (4, '43QE1943'),
    (4, '43QE2243'),
    (4, '43QE2143'),
    (4, '43QE24E1'),
    (4, '43QE25E1'),
    (4, '43QE26E1'),
    (4, '43QE27E1'),
    (4, '43QE29E1'),
    (5, '43U2DE53'),
    (6, '43IF5044'),
    (6, '43IF5073'),
    (6, '43IF5084');

/******************************************************/
-- Table TypeService
/******************************************************/
INSERT INTO `sde`.`TypeService` (nom, poids) VALUES("CM", 1.5);
INSERT INTO `sde`.`TypeService` (nom, poids) VALUES("TD", 1);
INSERT INTO `sde`.`TypeService` (nom, poids) VALUES("SPECIAL", 1);

/******************************************************/
-- Table Statut
/******************************************************/
INSERT INTO `sde`.`Statut`  (nom, heureService, titulaire)
VALUES
    ("PR", 192, 1),
    ("MCF", 192, 1),
    ("PRAG", 384, 1),
    ("ATER", 96, 0),
    ("MONITEUR", 384, 0),
    ("EXTERIEUR", 0, 0);


/******************************************************/
-- Table Enseignant
/******************************************************/
INSERT INTO `sde`.`Enseignant`  (nom, prenom, depEco, statut_idStatut)
VALUES
    ("DARMANGEAT", "CHRISTOPHE", 1, 3),
    ("GROUIEZ", "PASCALE", 1, 2),
    ("LAMARCHE", "THIERY", 1, 1),
    ("DOSQUET", "YVON", 1, 4),
    ("DUPONT EXTERIEUR", "JEAN", 0, 5),
    ("LERY", "JEAN-MICHEL", 0, 6);

/******************************************************/
-- Table Service (debug : services fictifs à modifier !)
/******************************************************/
INSERT INTO `sde`.`Service`  (Enseignant_idEnseignant, TypeService_idTypeService, annee, Enseignement_apogee, nbHeures, commentaire)
VALUES
    (1, 2, 2018, "54AEE2EC", 18, NULL),
    (2, 2, 2018, "54AEE2EC", 18, NULL),
    (2, 1, 2018, "54AEE2EC", 3, NULL),
    (3, 1, 2018, "54AEE2EC", 10, "Attention ce cours la est particuliers"),
    -- Service de type spécial (3), ne correspondant pas à un cours (apogee = null)
    (2, 3, 2018, null, 10, "Heures syndicales");


/******************************************************/
-- Table Utilisateur
-- 1 admin (CHRISTOPHE) et deux enseignants
/******************************************************/
INSERT INTO `sde`.`Utilisateur` (nom, email, authLevel, mdp, bckColor, headerColor)
VALUES
    ("CHRISTOPHE", "CRICRI@MAIL.COM", 1, "monmotdepasshashéde60CHAR", "yellow", "blue"),
    ("JEAN-LOUIS", "JEAN-LOUIS@MAIL.COM", 0, "monmotdepasshashéde60CHAR", "yellow", "blue"),
    ("FRED", "FRED@MAIL.COM", 0, "monmotdepasshashéde60CHAR", "yellow", "blue");

-- Debug : mysql en mode autocommit par défaut à supprimer
COMMIT;

-- Important car les procédures ne respectent pas un standard qui est activé d'office sur le serveur de prod
SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));