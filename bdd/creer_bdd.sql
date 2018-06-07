-- MySQL Script generated by MySQL Workbench
-- mer. 30 mai 2018 20:11:01 CEST
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sde
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `sde` ;

-- -----------------------------------------------------
-- Schema sde
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sde` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci ;
USE `sde` ;

-- -----------------------------------------------------
-- Table `sde`.`Statut`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Statut` ;

CREATE TABLE IF NOT EXISTS `sde`.`Statut` (
  `idStatut` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `heureService` INT NOT NULL,
  `titulaire` TINYINT NOT NULL,
  PRIMARY KEY (`idStatut`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nom_UNIQUE` ON `sde`.`Statut` (`nom` ASC);


-- -----------------------------------------------------
-- Table `sde`.`Enseignant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Enseignant` ;

CREATE TABLE IF NOT EXISTS `sde`.`Enseignant` (
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


-- -----------------------------------------------------
-- Table `sde`.`TypeService`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`TypeService` ;

CREATE TABLE IF NOT EXISTS `sde`.`TypeService` (
  `idTypeService` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTypeService`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nom_UNIQUE` ON `sde`.`TypeService` (`nom` ASC);


-- -----------------------------------------------------
-- Table `sde`.`Enseignement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Enseignement` ;

CREATE TABLE IF NOT EXISTS `sde`.`Enseignement` (
  `apogee` VARCHAR(45) NOT NULL,
  `intitule` VARCHAR(45) NOT NULL,
  `heureCM` INT NOT NULL,
  `heureTP` INT NOT NULL,
  `semestre` INT NOT NULL,
  `nbGroupes` INT NOT NULL,
  PRIMARY KEY (`apogee`))
ENGINE = InnoDB
ROW_FORMAT = DEFAULT;

CREATE UNIQUE INDEX `apogee_UNIQUE` ON `sde`.`Enseignement` (`apogee` ASC);


-- -----------------------------------------------------
-- Table `sde`.`Service`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Service` ;

CREATE TABLE IF NOT EXISTS `sde`.`Service` (
  `idService` INT NOT NULL AUTO_INCREMENT,
  `Enseignant_idEnseignant` INT NOT NULL,
  `TypeService_idTypeService` INT NOT NULL,
  `annee` INT NOT NULL COMMENT 'Annee du cours pour pouvoir tenir l\'historique des cours d\'anéne en année',
  `Enseignement_apogee` VARCHAR(45) NULL COMMENT 'Le champs Enseignement_apogee peut-être vide dans le cas des services qui ne sont pas des cous\n',
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
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_Service_Enseignant_id` ON `sde`.`Service` (`Enseignant_idEnseignant` ASC);

CREATE INDEX `fk_Service_TypeService_id` ON `sde`.`Service` (`TypeService_idTypeService` ASC);

CREATE INDEX `fk_Service_Enseignement_id` ON `sde`.`Service` (`Enseignement_apogee` ASC);


-- -----------------------------------------------------
-- Table `sde`.`Diplome`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Diplome` ;

CREATE TABLE IF NOT EXISTS `sde`.`Diplome` (
  `idDiplome` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idDiplome`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nom_UNIQUE` ON `sde`.`Diplome` (`nom` ASC);


-- -----------------------------------------------------
-- Table `sde`.`Formation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Formation` ;

CREATE TABLE IF NOT EXISTS `sde`.`Formation` (
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


-- -----------------------------------------------------
-- Table `sde`.`EnseignementFormation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`EnseignementFormation` ;

CREATE TABLE IF NOT EXISTS `sde`.`EnseignementFormation` (
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


-- -----------------------------------------------------
-- Table `sde`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`User` ;

CREATE TABLE IF NOT EXISTS `sde`.`User` (
  `idUser` INT NOT NULL,
  `nom` VARCHAR(45) NOT NULL,
  `mdp` VARCHAR(45) NOT NULL COMMENT 'mdp de longueure 60 correspondant à l\'output de la fonction password_hash de php',
  PRIMARY KEY (`idUser`))
ENGINE = InnoDB;

USE `sde` ;

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueListeEnseignant`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueListeEnseignant` (`nom` INT, `prenom` INT, `Departement` INT, `Tituaire` INT, `Categorie` INT, `HeuresDues` INT, `HeuresAffectees` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueListeEnseignement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueListeEnseignement` (`apogee` INT, `intitule` INT, `heureCM` INT, `heureTP` INT, `nbGroupes` INT, `heureTotale` INT, `semestre` INT, `formation` INT, `diplome` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueListeService`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueListeService` (`id` INT, `apogee` INT, `intitule` INT, `type` INT, `heure` INT, `annee` INT, `idEnseignant` INT, `nom` INT, `prenom` INT, `formation` INT, `diplome` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueListeFormation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueListeFormation` (`formation` INT, `diplome` INT, `heure_affectee` INT, `total_CM` INT, `total_TP` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueLabelEnseignant`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueLabelEnseignant` (`id` INT, `nom` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueLabelEnseignement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueLabelEnseignement` (`id` INT, `nom` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueLabelFormation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueLabelFormation` (`id` INT, `nom` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueLabelDiplome`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueLabelDiplome` (`id` INT, `nom` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueLabelStatut`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueLabelStatut` (`id` INT, `nom` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueLabelTypeService`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueLabelTypeService` (`id` INT, `nom` INT);

-- -----------------------------------------------------
-- procedure InsererEnseignement
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`InsererEnseignement`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE InsererEnseignement(IN p_apogee VARCHAR(45), IN p_intitule VARCHAR(45), IN p_heureCM INT, IN p_heureTP INT, IN p_semestre INT, IN p_nbGroupes INT, IN p_idFormation INT)
BEGIN
	INSERT INTO `sde`.`Enseignement` (apogee, intitule, heureCM, heureTP, semestre, nbGroupes)
	VALUES (UPPER(p_apogee), p_intitule, p_heureCM, p_heureTP, p_semestre, p_nbGroupes);
	-- lien Enseignement - EnseignementsFormations
    INSERT INTO `sde`.`EnseignementFormation` (Formation_idFormation, Enseignement_apogee)
    VALUES (p_idFormation, p_apogee);
    -- lien EnseignementsFormations - Formation
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure InsererService
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`InsererService`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `InsererService` (IN p_apogee VARCHAR(45), IN p_idEnseignant INT, IN p_idTypeService INT, IN p_annee INT, IN p_nbHeures INT)
BEGIN
	-- Vérifier que le nouveau cours ne va pas dépasser le nb d'heure de cours de l'enseignement
	DECLARE v_valide BOOLEAN;
    CALL VerifierNbHCours (p_apogee, p_nbHeures, p_idTypeService, p_annee, v_valide);
    IF (v_valide)
    THEN
		INSERT INTO `sde`.`Service` (Enseignant_idEnseignant, TypeService_idTypeService, annee, Enseignement_apogee, nbHeures)
		VALUES (p_idEnseignant, p_idTypeService, p_annee, UPPER(p_apogee), p_nbHeures);
	END IF;
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure InsererFormation
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`InsererFormation`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `InsererFormation` (IN p_nom VARCHAR(45), IN p_idDiplome INT)
BEGIN
	INSERT INTO `sde`.`Formation` (nom, Diplome_idDiplome)
	VALUES (p_nom, p_idDiplome);
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure ModifierEnseignant
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`ModifierEnseignant`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `ModifierEnseignant` (IN p_idEnseignant INT, IN p_nom VARCHAR(45), IN p_prenom VARCHAR(45), IN p_idStatut INT)
BEGIN
	UPDATE `sde`.`Enseignant`
    SET 
		nom = UPPER(p_nom),
        prenom = UPPER(p_prenom),
        Statut_idStatut = p_idStatut
	WHERE
		idEnseignant = p_idEnseignant;
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure ModifierService
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`ModifierService`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `ModifierService` (IN p_idService INT, IN p_apogee VARCHAR(45), IN p_idEnseignant INT, IN p_idTypeService INT, IN p_annee INT,  IN p_nbHeures INT)
BEGIN
	-- Vérifier que les modifications sur le nbHeure du cours ne va pas dépasser le nb d'heure de cours de l'enseignement
	DECLARE v_valide BOOLEAN;
    
    -- On va prendre en compte l'ancien horaire du cours et faire la différence avec le nouveau
    -- pour pouvoir utiliser la procédure VerifierNbHCours
    DECLARE v_ancienNbHeures INT;
    DECLARE v_nouveauNbHeures INT;
    SELECT nbHeures INTO v_ancienNbHeures FROM `sde`.`Service` WHERE idService = p_idService;
    SET v_nouveauNbHeures = p_nbHeures - v_ancienNbHeures;

    CALL VerifierNbHCours (p_apogee, v_nouveauNbHeures, p_idTypeService, p_annee, v_valide);

	-- Si le nombre d'heure est valide on fait l'update
    IF (v_valide)
    THEN
		UPDATE `sde`.`Service`
		SET 
			Enseignant_idEnseignant = p_idEnseignant,
			TypeService_idTypeService = p_idTypeService,
			annee = p_annee,
			Enseignement_apogee = p_apogee,
			nbHeures = p_nbHeures
		WHERE
			idService = p_idService;
	END IF;
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure ModifierEnseignement
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`ModifierEnseignement`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `ModifierEnseignement` (IN p_apogeeOri VARCHAR(45), IN p_apogee VARCHAR(45), IN p_intitule VARCHAR(45), IN p_heureCM INT, IN p_heureTP INT, IN p_semestre INT, IN p_nbGroupes INT)
BEGIN
	UPDATE `sde`.`Enseignement` 
    SET 
		apogee = UPPER(p_apogee),
        intitule = p_intitule,
        heureCM = p_heureCM,
        heureTP = p_heureTP,
        semestre = p_semestre,
        nbGroupes = p_nbGroupes
	WHERE
		apogee = p_apogeeOri;
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure ModifierFormation
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`ModifierFormation`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `ModifierFormation` (IN p_nom_ori VARCHAR(45), IN p_nom VARCHAR(45), IN p_idDiplome INT)
BEGIN
	SELECT idFormation FROM `sde`.`Formation` WHERE nom = UPPER(p_nom_ori) INTO @idFormation;

	UPDATE `sde`.`Formation`
    SET
		nom = UPPER(p_nom),
		Diplome_idDiplome = p_idDiplome
    WHERE
		idFormation = @idFormation;
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure SupprimerService
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`SupprimerService`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `SupprimerService` (IN p_idService INT)
BEGIN
	DELETE FROM `sde`.`Service` WHERE idService = p_idService;
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure CalculerNbHeuresAffectees
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`CalculerNbHeuresAffectees`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `CalculerNbHeuresAffectees` (IN p_apogee VARCHAR(45), IN p_typeService INT, IN p_annee INT, OUT p_nbHeures INT)
BEGIN
	IF (p_typeService = 1)
    THEN
		SELECT SUM(`sde`.`Service`.`nbHeures`) INTO p_nbHeures
		FROM
			`sde`.`Service`
		INNER JOIN
			`sde`.`TypeService` ON `sde`.`TypeService`.`idTypeService` = `sde`.`Service`.`TypeService_idTypeService`
		WHERE
			`sde`.`Service`.`Enseignement_apogee` = p_apogee AND
			`sde`.`TypeService`.`idTypeService` = 1 AND
            `sde`.`Service`.`annee` = p_annee
		;
	ELSE
		SELECT SUM(`sde`.`Service`.`nbHeures`) INTO p_nbHeures
		FROM
			`sde`.`Service`
		INNER JOIN
			`sde`.`TypeService` ON `sde`.`TypeService`.`idTypeService` = `sde`.`Service`.`TypeService_idTypeService`
		WHERE
			`sde`.`Service`.`Enseignement_apogee` = p_apogee AND
			`sde`.`TypeService`.`idTypeService` = 2 AND
            `sde`.`Service`.`annee` = p_annee
		;
	END IF;
    
	-- Initialisé la variable à zerro dans le cas ou il n'y a pas encore de cours affecté
    IF (p_nbHeures IS NULL)
    THEN
		SELECT 0 INTO p_nbHeures;
	END IF;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure VerifierNbHCours
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`VerifierNbHCours`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `VerifierNbHCours` (IN p_apogee VARCHAR(45), IN p_nbHeures INT, IN p_typeService INT, IN p_annee INT, OUT valide BOOLEAN)
BEGIN
	-- Déclarer variables
    DECLARE v_nbHDejaAffectee INT;
    DECLARE v_nbHTemp INT;
    DECLARE v_nbHTotal INT;
    -- Initialiser les variables
    -- Le nombre d'heure déjà affecté dans l'ensemble des cours existant de l'enseignement
	CALL CalculerNbHeuresAffectees(UPPER(p_apogee), p_typeService, p_annee, v_nbHDejaAffectee);
    -- Selectionne le nombre d'heure de l'enseignement en fonction du typed
    If (p_typeService = 1)
    THEN
		-- Selectionne la valeur du champ heureCM
		SELECT `sde`.`Enseignement`.`heureCM` INTO v_nbHTotal
		FROM `sde`.`Enseignement`
		WHERE `sde`.`Enseignement`.`apogee` = UPPER(p_apogee);
	ELSE
		-- Selectionne nbGroupe * heureTP
		SELECT `sde`.`Enseignement`.`heureTP` *  `sde`.`Enseignement`.`nbGroupes` INTO v_nbHTotal
		FROM `sde`.`Enseignement`
		WHERE `sde`.`Enseignement`.`apogee` = UPPER(p_apogee);
    END IF;
    -- Calcule le nouveau temps (fait la somme)
    SET v_nbHTemp = v_nbHDejaAffectee +  p_nbHeures;
    -- Vérifie que le nombre d'heure de cours d'un enseignement ne dépasse pas le nb CM 
    IF (v_nbHTemp <= v_nbHTotal)
    THEN
		SELECT TRUE INTO valide;
	ELSE
		SELECT FALSE INTO valide;
	END IF;
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure InsererEnseignant
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`InsererEnseignant`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE InsererEnseignant(IN p_nom VARCHAR(45), IN p_prenom VARCHAR(45), IN p_idStatut INT, IN p_depEco INT)
BEGIN
    INSERT INTO `sde`.`Enseignant` (nom, prenom, Statut_idStatut, depEco)
    VALUES (UPPER(p_nom), UPPER(p_prenom), p_idStatut, p_depEco);
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- View `sde`.`VueListeEnseignant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`VueListeEnseignant`;
DROP VIEW IF EXISTS `sde`.`VueListeEnseignant` ;
USE `sde`;
CREATE  OR REPLACE VIEW VueListeEnseignant AS
SELECT
    `sde`.`Enseignant`.`nom`,
    `sde`.`Enseignant`.`prenom`,
    if(`sde`.`Enseignant`.`depEco`, "SDE", "Hors SDE") AS Departement,
    if(`sde`.`Statut`.`titulaire`, "Titulaire", "Non-Titulaire") AS Tituaire,
    `sde`.`Statut`.`nom` AS Categorie,
    `sde`.`Statut`.`heureService` AS HeuresDues,
    SUM(`sde`.`Service`.`nbHeures`) AS HeuresAffectees
FROM
    `sde`.`Service`
INNER JOIN
    `sde`.`Enseignant` ON `sde`.`Enseignant`.`idEnseignant` = `sde`.`Service`.`Enseignant_idEnseignant`
INNER JOIN
	`sde`.`Statut` ON `sde`.`Statut`.`idStatut` = `sde`.`Enseignant`.`Statut_idStatut`
GROUP BY
	`sde`.`Enseignant`.`idEnseignant`
;

-- -----------------------------------------------------
-- View `sde`.`VueListeEnseignement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`VueListeEnseignement`;
DROP VIEW IF EXISTS `sde`.`VueListeEnseignement` ;
USE `sde`;
CREATE  OR REPLACE VIEW VueListeEnseignement AS
SELECT
    `sde`.`Enseignement`.`apogee`,
    `sde`.`Enseignement`.`intitule`,
    `sde`.`Enseignement`.`heureCM`,
    `sde`.`Enseignement`.`heureTP`,
    `sde`.`Enseignement`.`nbGroupes`,
    `sde`.`Enseignement`.`heureTP`*`sde`.`Enseignement`.`nbGroupes`+`sde`.`Enseignement`.`heureCM` AS heureTotale,
    `sde`.`Enseignement`.`semestre`,
    `sde`.`Formation`.`nom` AS formation,
    `sde`.`Diplome`.`nom` AS diplome
FROM
    `sde`.`Enseignement`
INNER JOIN
    `sde`.`EnseignementFormation` ON `sde`.`EnseignementFormation`.`Enseignement_apogee` = `sde`.`Enseignement`.`apogee`
INNER JOIN
    `sde`.`Formation` ON `sde`.`Formation`.`idFormation` = `sde`.`EnseignementFormation`.`Formation_idFormation`
INNER JOIN
  	`sde`.`Diplome` ON `sde`.`Diplome`.`idDiplome` = `sde`.`Formation`.`Diplome_idDiplome`
;

-- -----------------------------------------------------
-- View `sde`.`VueListeService`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`VueListeService`;
DROP VIEW IF EXISTS `sde`.`VueListeService` ;
USE `sde`;
CREATE  OR REPLACE VIEW VueListeService AS
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
    `sde`.`Diplome`.`nom` AS diplome
FROM
    `sde`.`Service`
LEFT JOIN
    `sde`.`Enseignement` ON `sde`.`Enseignement`.`apogee` = `sde`.`Service`.`Enseignement_apogee`
LEFT JOIN
	`EnseignementFormation` ON `EnseignementFormation`.`Enseignement_apogee` = `Enseignement`.`apogee`
LEFT JOIN
	`Formation` ON `Formation`.`idFormation` = `EnseignementFormation`.`Formation_idFormation`
LEFT JOIN
	`Diplome` ON `Diplome`.`idDiplome` = `Formation`.`idFormation`
INNER JOIN
    `sde`.`TypeService` ON `sde`.`TypeService`.`idTypeService` = `sde`.`Service`.`TypeService_idTypeService`
INNER JOIN
    `sde`.`Enseignant` ON `sde`.`Enseignant`.`idEnseignant` = `sde`.`Service`.`Enseignant_idEnseignant`
;

-- -----------------------------------------------------
-- View `sde`.`VueListeFormation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`VueListeFormation`;
DROP VIEW IF EXISTS `sde`.`VueListeFormation` ;
USE `sde`;
CREATE  OR REPLACE VIEW `VueListeFormation` AS
SELECT
	`sde`.`Formation`.`nom` AS formation,
    `sde`.`Diplome`.`nom` AS diplome,
	SUM(`Service`.`nbHeures`) AS heure_affectee,
    SUM(`Enseignement`.`heureCM`) AS total_CM,
    SUM(`Enseignement`.`heureTP` * `Enseignement`.`nbGroupes`) AS total_TP
FROM `Service`
INNER JOIN `Enseignement` ON `Enseignement`.`apogee` = `Service`.`Enseignement_apogee`
INNER JOIN `EnseignementFormation` ON `EnseignementFormation`.`Enseignement_apogee` = `Enseignement`.`apogee`
INNER JOIN `Formation` ON `Formation`.`idFormation` = `EnseignementFormation`.`Formation_idFormation`
INNER JOIN `Diplome` ON `Diplome`.`idDiplome` = `Formation`.`idFormation`
GROUP BY `Formation`.`idFormation`;

-- -----------------------------------------------------
-- View `sde`.`VueLabelEnseignant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`VueLabelEnseignant`;
DROP VIEW IF EXISTS `sde`.`VueLabelEnseignant` ;
USE `sde`;
CREATE  OR REPLACE VIEW `VueLabelEnseignant` AS
SELECT 
	`sde`.`Enseignant`.`idEnseignant` AS id,
	CONCAT(`sde`.`Enseignant`.`nom`, " ", `sde`.`Enseignant`.`prenom`) AS nom
FROM
	`sde`.`Enseignant`;

-- -----------------------------------------------------
-- View `sde`.`VueLabelEnseignement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`VueLabelEnseignement`;
DROP VIEW IF EXISTS `sde`.`VueLabelEnseignement` ;
USE `sde`;
CREATE  OR REPLACE VIEW `VueLabelEnseignement` AS
SELECT 
	`sde`.`Enseignement`.`apogee` as id,
	`sde`.`Enseignement`.`intitule`as nom
FROM
	`sde`.`Enseignement`;

-- -----------------------------------------------------
-- View `sde`.`VueLabelFormation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`VueLabelFormation`;
DROP VIEW IF EXISTS `sde`.`VueLabelFormation` ;
USE `sde`;
CREATE  OR REPLACE VIEW `VueLabelFormation` AS
SELECT 
	`sde`.`Formation`.`idFormation` as id,
	`sde`.`Formation`.`nom` as nom
FROM
	`sde`.`Formation`;

-- -----------------------------------------------------
-- View `sde`.`VueLabelDiplome`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`VueLabelDiplome`;
DROP VIEW IF EXISTS `sde`.`VueLabelDiplome` ;
USE `sde`;
CREATE  OR REPLACE VIEW `VueLabelDiplome` AS
SELECT 
	`sde`.`Diplome`.`idDiplome` as id,
	`sde`.`Diplome`.`nom` as nom
FROM
	`sde`.`Diplome`;

-- -----------------------------------------------------
-- View `sde`.`VueLabelStatut`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`VueLabelStatut`;
DROP VIEW IF EXISTS `sde`.`VueLabelStatut` ;
USE `sde`;
CREATE  OR REPLACE VIEW `VueLabelStatut` AS
SELECT 
	`sde`.`Statut`.`idStatut` as id,
	`sde`.`Statut`.`nom`
FROM
	`sde`.`Statut`;

-- -----------------------------------------------------
-- View `sde`.`VueLabelTypeService`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`VueLabelTypeService`;
DROP VIEW IF EXISTS `sde`.`VueLabelTypeService` ;
USE `sde`;
CREATE  OR REPLACE VIEW `VueLabelTypeService` AS
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
