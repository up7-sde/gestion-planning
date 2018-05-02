-- MySQL Script generated by MySQL Workbench
-- mer. 02 mai 2018 21:33:32 CEST
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
-- Table `sde`.`Categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Categories` ;

CREATE TABLE IF NOT EXISTS `sde`.`Categories` (
  `idCategories` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  `heureService` INT NOT NULL,
  `Categories_idCategories` INT NULL,
  PRIMARY KEY (`idCategories`),
  CONSTRAINT `fk_Categories_Categories1`
    FOREIGN KEY (`Categories_idCategories`)
    REFERENCES `sde`.`Categories` (`idCategories`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Categories_Categories1_idx` ON `sde`.`Categories` (`Categories_idCategories` ASC);


-- -----------------------------------------------------
-- Table `sde`.`Enseignants`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Enseignants` ;

CREATE TABLE IF NOT EXISTS `sde`.`Enseignants` (
  `idEnseignants` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `prenom` VARCHAR(45) NOT NULL,
  `Categories_idCategories` INT NOT NULL,
  PRIMARY KEY (`idEnseignants`),
  CONSTRAINT `fk_Enseignants_Categories1`
    FOREIGN KEY (`Categories_idCategories`)
    REFERENCES `sde`.`Categories` (`idCategories`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Enseignants_Categories1_idx` ON `sde`.`Enseignants` (`Categories_idCategories` ASC);


-- -----------------------------------------------------
-- Table `sde`.`TypesCours`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`TypesCours` ;

CREATE TABLE IF NOT EXISTS `sde`.`TypesCours` (
  `idTypesCours` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTypesCours`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sde`.`Enseignements`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Enseignements` ;

CREATE TABLE IF NOT EXISTS `sde`.`Enseignements` (
  `apogee` VARCHAR(45) NOT NULL,
  `intitule` VARCHAR(45) NOT NULL,
  `heureCM` INT NOT NULL,
  `heureTP` INT NOT NULL,
  `semestre` INT NOT NULL,
  `nbGroupes` INT NOT NULL,
  PRIMARY KEY (`apogee`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `apogee_UNIQUE` ON `sde`.`Enseignements` (`apogee` ASC);


-- -----------------------------------------------------
-- Table `sde`.`Cours`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Cours` ;

CREATE TABLE IF NOT EXISTS `sde`.`Cours` (
  `idCours` INT NOT NULL AUTO_INCREMENT,
  `Enseignants_idEnseignants` INT NOT NULL,
  `TypesCours_idTypesCours` INT NOT NULL,
  `annee` INT NOT NULL COMMENT 'Annee du cours pour pouvoir tenir l\'historique des cours d\'anéne en année',
  `Enseignements_apogee` VARCHAR(45) NOT NULL,
  `nbHeures` INT NOT NULL,
  PRIMARY KEY (`idCours`),
  CONSTRAINT `fk_Cours_Enseignants1`
    FOREIGN KEY (`Enseignants_idEnseignants`)
    REFERENCES `sde`.`Enseignants` (`idEnseignants`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cours_TypesCours1`
    FOREIGN KEY (`TypesCours_idTypesCours`)
    REFERENCES `sde`.`TypesCours` (`idTypesCours`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cours_Enseignements1`
    FOREIGN KEY (`Enseignements_apogee`)
    REFERENCES `sde`.`Enseignements` (`apogee`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_Cours_Enseignants1_idx` ON `sde`.`Cours` (`Enseignants_idEnseignants` ASC);

CREATE INDEX `fk_Cours_TypesCours1_idx` ON `sde`.`Cours` (`TypesCours_idTypesCours` ASC);

CREATE INDEX `fk_Cours_Enseignements1_idx` ON `sde`.`Cours` (`Enseignements_apogee` ASC);


-- -----------------------------------------------------
-- Table `sde`.`Diplomes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Diplomes` ;

CREATE TABLE IF NOT EXISTS `sde`.`Diplomes` (
  `idDiplomes` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idDiplomes`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nom_UNIQUE` ON `sde`.`Diplomes` (`nom` ASC);


-- -----------------------------------------------------
-- Table `sde`.`Formations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Formations` ;

CREATE TABLE IF NOT EXISTS `sde`.`Formations` (
  `idFormations` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `Diplomes_idDiplomes` INT NOT NULL,
  PRIMARY KEY (`idFormations`),
  CONSTRAINT `fk_Formations_Diplomes1`
    FOREIGN KEY (`Diplomes_idDiplomes`)
    REFERENCES `sde`.`Diplomes` (`idDiplomes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Formations_Diplomes1_idx` ON `sde`.`Formations` (`Diplomes_idDiplomes` ASC);

CREATE UNIQUE INDEX `nom_UNIQUE` ON `sde`.`Formations` (`nom` ASC);


-- -----------------------------------------------------
-- Table `sde`.`EnseignementsFormations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`EnseignementsFormations` ;

CREATE TABLE IF NOT EXISTS `sde`.`EnseignementsFormations` (
  `Formations_idFormations` INT NOT NULL AUTO_INCREMENT,
  `Enseignements_apogee` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Formations_idFormations`, `Enseignements_apogee`),
  CONSTRAINT `fk_EnseignementsFormations_Formations`
    FOREIGN KEY (`Formations_idFormations`)
    REFERENCES `sde`.`Formations` (`idFormations`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EnseignementsFormations_Enseignements1`
    FOREIGN KEY (`Enseignements_apogee`)
    REFERENCES `sde`.`Enseignements` (`apogee`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_EnseignementsFormations_Formations_idx` ON `sde`.`EnseignementsFormations` (`Formations_idFormations` ASC);

CREATE INDEX `fk_EnseignementsFormations_Enseignements1_idx` ON `sde`.`EnseignementsFormations` (`Enseignements_apogee` ASC);

USE `sde` ;

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueListeEnseignants`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueListeEnseignants` (`nom` INT, `prenom` INT, `Categorie` INT, `heureService` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueListeEnseignements`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueListeEnseignements` (`apogee` INT, `intitule` INT, `heureCM` INT, `heureTP` INT, `semestre` INT, `nbGroupes` INT, `formation` INT, `diplome` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueListeCours`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueListeCours` (`apogee` INT, `intitule` INT, `type` INT, `nbHeures` INT, `annee` INT, `idEnseignants` INT, `nom` INT, `prenom` INT);

-- -----------------------------------------------------
-- procedure InsererEnseignant
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`InsererEnseignant`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE InsererEnseignant(IN p_nom VARCHAR(45), IN p_prenom VARCHAR(45), IN p_idCategories INT)
BEGIN
    INSERT INTO `sde`.`Enseignants` (nom, prenom, Categories_idCategories)
    VALUES (UPPER(p_nom), UPPER(p_prenom), p_idCategories);
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure InsererEnseignement
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`InsererEnseignement`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE InsererEnseignement(IN p_apogee VARCHAR(45), IN p_intitule VARCHAR(45), IN p_heureCM INT, IN p_heureTP INT, IN p_semestre INT, IN p_nbGroupes INT)
BEGIN
	INSERT INTO `sde`.`Enseignements` (apogee, intitule, heureCM, heureTP, semestre, nbGroupes)
	VALUES (UPPER(p_apogee), p_intitule, p_heureCM, p_heureTP, p_semestre, p_nbGroupes);
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure InsererCours
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`InsererCours`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `InsererCours` (IN p_idEnseignants INT, IN p_idTypesCours INT, IN p_annee INT, IN p_apogee VARCHAR(45), IN p_nbHeures INT)
BEGIN
	-- Vérifier que le nouveau cours ne va pas dépasser le nb d'heure de cours de l'enseignement
	DECLARE v_valide BOOLEAN;
    CALL VerifierNbHCours (p_apogee, p_nbHeures, p_idTypesCours, v_valide);
    IF (v_valide)
    THEN
		INSERT INTO `sde`.`Cours` (Enseignants_idEnseignants, TypesCours_idTypesCours, annee, Enseignements_apogee, nbHeures)
		VALUES (p_idEnseignants, p_idTypesCours, p_annee, UPPER(p_apogee), p_nbHeures);
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
	INSERT INTO `sde`.`Formations` (nom, Diplomes_idDiplomes)
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
CREATE PROCEDURE `ModifierEnseignant` (IN p_idEnseignants INT, IN p_nom VARCHAR(45), IN p_prenom VARCHAR(45), IN p_idCategories INT)
BEGIN
	UPDATE `sde`.`Enseignants`
    SET 
		nom = UPPER(p_nom),
        prenom = UPPER(p_prenom),
        Categories_idCategories = p_idCategories
	WHERE
		idEnseignants = p_idEnseignants;
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure ModifierCours
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`ModifierCours`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `ModifierCours` (IN p_idCours INT, IN p_idEnseignants INT, IN p_idTypesCours INT, IN p_annee INT, IN p_apogee VARCHAR(45), IN p_nbHeures INT)
BEGIN
	UPDATE `sde`.`Cours`
    SET 
		Enseignants_idEnseignants = p_idEnseignants,
        TypesCours_idTypesCours = p_idTypesCours,
        annee = p_annee,
        Enseignements_apogee = p_apogee,
        nbHeures = p_nbHeures
	WHERE
		idCours = p_idCours;
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
	UPDATE `sde`.`Enseignements` 
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
CREATE PROCEDURE `ModifierFormation` (IN p_nom_ori VARCHAR(45), IN p_nom VARCHAR(45), IN p_idDiplomes INT)
BEGIN
	SELECT idFormations FROM `sde`.`Formations` WHERE nom = UPPER(p_nom_ori) INTO @idFormations;

	UPDATE `sde`.`Formations`
    SET
		nom = UPPER(p_nom),
		Diplomes_idDiplomes = p_idDiplomes
    WHERE
		idFormations = @idFormations;
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure SupprimerCours
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`SupprimerCours`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `SupprimerCours` (IN p_idCours INT)
BEGIN
	DELETE FROM `sde`.`Cours` WHERE idCours = p_idCours;
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure CalculerNbHeuresAffectees
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`CalculerNbHeuresAffectees`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `CalculerNbHeuresAffectees` (IN p_apogee VARCHAR(45), IN p_typeCours INT, OUT nbHeures INT)
BEGIN
	IF (p_typeCours = 1)
    THEN
		SELECT SUM(`sde`.`Cours`.`nbHeures`) INTO nbHeures
		FROM
			`sde`.`Cours`
		INNER JOIN
			`sde`.`TypesCours` ON `sde`.`TypesCours`.`idTypesCours` = `sde`.`Cours`.`TypesCours_idTypesCours`
		WHERE
			`sde`.`Cours`.`Enseignements_apogee` = p_apogee AND
			`sde`.`TypesCours`.`idTypesCours` = 1
		;
	ELSE
				SELECT SUM(`sde`.`Cours`.`nbHeures`) INTO nbHeures
		FROM
			`sde`.`Cours`
		INNER JOIN
			`sde`.`TypesCours` ON `sde`.`TypesCours`.`idTypesCours` = `sde`.`Cours`.`TypesCours_idTypesCours`
		WHERE
			`sde`.`Cours`.`Enseignements_apogee` = p_apogee AND
			`sde`.`TypesCours`.`idTypesCours` = 2
		;
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
CREATE PROCEDURE `VerifierNbHCours` (IN p_apogee VARCHAR(45), IN p_nbHeures INT, IN p_typeCours INT, OUT valide BOOLEAN)
BEGIN
	-- Déclarer variables
    DECLARE v_nbHDejaAffectee INT;
    DECLARE v_nbHTemp INT;
    DECLARE v_nbHCMTotal INT;
    -- Initialiser les variables
    -- Le nombre d'heure déjà affecté dans l'ensemble des cours existant de l'enseignement
	CALL CalculerNbHeuresAffectees(UPPER(p_apogee), p_typeCours, v_nbHDejaAffectee);
    -- Selectionne le nombre d'heure de l'enseignement
    SELECT `sde`.`Enseignements`.`heureCM` INTO v_nbHCMTotal
    FROM `sde`.`Enseignements`
    WHERE `sde`.`Enseignements`.`apogee` = UPPER(p_apogee);
    -- Calcule le nouveau temps (fait la somme)
    SET v_nbHTemp = v_nbHDejaAffectee +  p_nbHeures;
    -- Vérifie que le nombre d'heure de cours d'un enseignement ne dépasse pas le nb CM 
    IF (v_nbHTemp <= v_nbHCMTotal) THEN
		SELECT TRUE INTO valide;
	ELSE
		SELECT FALSE INTO valide;
	END IF;
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- View `sde`.`VueListeEnseignants`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `sde`.`VueListeEnseignants` ;
DROP TABLE IF EXISTS `sde`.`VueListeEnseignants`;
USE `sde`;
CREATE  OR REPLACE VIEW VueListeEnseignants AS
SELECT
    `sde`.`Enseignants`.`nom`,
    `sde`.`Enseignants`.`prenom`,
    `sde`.`Categories`.`nom` AS Categorie,
    `sde`.`Categories`.`heureService`
FROM
    `sde`.`Enseignants`
INNER JOIN
    `sde`.`Categories` ON `sde`.`Categories`.`idCategories` = `sde`.`Enseignants`.`Categories_idCategories`
;

-- -----------------------------------------------------
-- View `sde`.`VueListeEnseignements`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `sde`.`VueListeEnseignements` ;
DROP TABLE IF EXISTS `sde`.`VueListeEnseignements`;
USE `sde`;
CREATE  OR REPLACE VIEW VueListeEnseignements AS
SELECT
    `sde`.`Enseignements`.`apogee`,
    `sde`.`Enseignements`.`intitule`,
    `sde`.`Enseignements`.`heureCM`,
    `sde`.`Enseignements`.`heureTP`,
    `sde`.`Enseignements`.`semestre`,
    `sde`.`Enseignements`.`nbGroupes`,
    `sde`.`Formations`.`nom` as formation,
    `sde`.`Diplomes`.`nom` as diplome

FROM
    `sde`.`Enseignements`
INNER JOIN
    `sde`.`EnseignementsFormations` ON `sde`.`EnseignementsFormations`.`Enseignements_apogee` = `sde`.`Enseignements`.`apogee`
INNER JOIN
    `sde`.`Formations` ON `sde`.`Formations`.`idFormations` = `sde`.`EnseignementsFormations`.`Formations_idFormations`
INNER JOIN
	`sde`.`Diplomes` ON `sde`.`Diplomes`.`idDiplomes` = `sde`.`Formations`.`Diplomes_idDiplomes`;

-- -----------------------------------------------------
-- View `sde`.`VueListeCours`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `sde`.`VueListeCours` ;
DROP TABLE IF EXISTS `sde`.`VueListeCours`;
USE `sde`;
CREATE  OR REPLACE VIEW VueListeCours AS
SELECT
    `sde`.`Enseignements`.`apogee`,
    `sde`.`Enseignements`.`intitule`,
    `sde`.`TypesCours`.`nom` AS type,
    `sde`.`Cours`.`nbHeures`,
    `sde`.`Cours`.`annee`,
    `sde`.`Enseignants`.`idEnseignants`,
    `sde`.`Enseignants`.`nom`,
    `sde`.`Enseignants`.`prenom`
FROM
    `sde`.`Cours`
INNER JOIN
    `sde`.`Enseignements` ON `sde`.`Enseignements`.`apogee` = `sde`.`Cours`.`Enseignements_apogee`
INNER JOIN
    `sde`.`TypesCours` ON `sde`.`TypesCours`.`idTypesCours` = `sde`.`Cours`.`TypesCours_idTypesCours`
INNER JOIN
    `sde`.`Enseignants` ON `sde`.`Enseignants`.`idEnseignants` = `sde`.`Cours`.`Enseignants_idEnseignants`
;
SET SQL_MODE = '';
GRANT USAGE ON *.* TO admin;
 DROP USER admin;
SET SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
CREATE USER 'admin' IDENTIFIED BY 'wqa&2ZSX';

SET SQL_MODE = '';
GRANT USAGE ON *.* TO enseignant;
 DROP USER enseignant;
SET SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
CREATE USER 'enseignant' IDENTIFIED BY 'wqa&2ZSX';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
