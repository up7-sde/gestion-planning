-- MySQL Script generated by MySQL Workbench
-- ven. 04 mai 2018 21:18:24 CEST
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
-- Table `sde`.`Statuts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Statuts` ;

CREATE TABLE IF NOT EXISTS `sde`.`Statuts` (
  `idStatuts` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `heureService` INT NOT NULL,
  `titulaire` TINYINT NOT NULL,
  PRIMARY KEY (`idStatuts`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nom_UNIQUE` ON `sde`.`Statuts` (`nom` ASC);


-- -----------------------------------------------------
-- Table `sde`.`Enseignants`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`Enseignants` ;

CREATE TABLE IF NOT EXISTS `sde`.`Enseignants` (
  `idEnseignants` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `prenom` VARCHAR(45) NOT NULL,
  `depEco` TINYINT NOT NULL,
  `Statuts_idStatuts` INT NOT NULL,
  PRIMARY KEY (`idEnseignants`),
  CONSTRAINT `fk_Enseignants_Statuts1`
    FOREIGN KEY (`Statuts_idStatuts`)
    REFERENCES `sde`.`Statuts` (`idStatuts`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Enseignants_Statuts1_idx` ON `sde`.`Enseignants` (`Statuts_idStatuts` ASC);


-- -----------------------------------------------------
-- Table `sde`.`TypesCours`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sde`.`TypesCours` ;

CREATE TABLE IF NOT EXISTS `sde`.`TypesCours` (
  `idTypesCours` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTypesCours`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nom_UNIQUE` ON `sde`.`TypesCours` (`nom` ASC);


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
ENGINE = InnoDB
ROW_FORMAT = DEFAULT;

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
CREATE TABLE IF NOT EXISTS `sde`.`VueListeEnseignants` (`nom` INT, `prenom` INT, `Departement` INT, `Tituaire` INT, `Categorie` INT, `Titulaire` INT, `HeuresDues` INT, `HeuresAffectees` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueListeEnseignements`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueListeEnseignements` (`apogee` INT, `intitule` INT, `heureCM` INT, `heureTP` INT, `nbGroupes` INT, `heureTotale` INT, `semestre` INT, `formation` INT, `diplome` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sde`.`VueListeCours`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sde`.`VueListeCours` (`apogee` INT, `intitule` INT, `type` INT, `nbHeures` INT, `annee` INT, `idEnseignants` INT, `nom` INT, `prenom` INT);

-- -----------------------------------------------------
-- procedure InsererEnseignement
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`InsererEnseignement`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE InsererEnseignement(IN p_apogee VARCHAR(45), IN p_intitule VARCHAR(45), IN p_heureCM INT, IN p_heureTP INT, IN p_semestre INT, IN p_nbGroupes INT, IN p_idFormation INT)
BEGIN
	INSERT INTO `sde`.`Enseignements` (apogee, intitule, heureCM, heureTP, semestre, nbGroupes)
	VALUES (UPPER(p_apogee), p_intitule, p_heureCM, p_heureTP, p_semestre, p_nbGroupes);
	-- lien Enseignement - EnseignementsFormations
    INSERT INTO `sde`.`EnseignementsFormations` (Formations_idFormations, Enseignements_apogee)
    VALUES (p_idFormation, p_apogee);
    -- lien EnseignementsFormations - Formation
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
    CALL VerifierNbHCours (p_apogee, p_nbHeures, p_idTypesCours, p_annee, v_valide);
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
CREATE PROCEDURE `ModifierEnseignant` (IN p_idEnseignants INT, IN p_nom VARCHAR(45), IN p_prenom VARCHAR(45), IN p_idStatuts INT)
BEGIN
	UPDATE `sde`.`Enseignants`
    SET 
		nom = UPPER(p_nom),
        prenom = UPPER(p_prenom),
        Statuts_idStatuts = p_idStatuts
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
	-- Vérifier que les modifications sur le nbHeure du cours ne va pas dépasser le nb d'heure de cours de l'enseignement
	DECLARE v_valide BOOLEAN;
    
    -- On va prendre en compte l'ancien horaire du cours et faire la différence avec le nouveau
    -- pour pouvoir utiliser la procédure VerifierNbHCours
    DECLARE v_ancienNbHeures INT;
    DECLARE v_nouveauNbHeures INT;
    SELECT nbHeures INTO v_ancienNbHeures FROM `sde`.`Cours` WHERE idCours = p_idCours;
    SET v_nouveauNbHeures = p_nbHeures - v_ancienNbHeures;

    CALL VerifierNbHCours (p_apogee, v_nouveauNbHeures, p_idTypesCours, p_annee, v_valide);

	-- Si le nombre d'heure est valide on fait l'update
    IF (v_valide)
    THEN
		UPDATE `sde`.`Cours`
		SET 
			Enseignants_idEnseignants = p_idEnseignants,
			TypesCours_idTypesCours = p_idTypesCours,
			annee = p_annee,
			Enseignements_apogee = p_apogee,
			nbHeures = p_nbHeures
		WHERE
			idCours = p_idCours;
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
CREATE PROCEDURE `CalculerNbHeuresAffectees` (IN p_apogee VARCHAR(45), IN p_typeCours INT, IN p_annee INT, OUT p_nbHeures INT)
BEGIN
	IF (p_typeCours = 1)
    THEN
		SELECT SUM(`sde`.`Cours`.`nbHeures`) INTO p_nbHeures
		FROM
			`sde`.`Cours`
		INNER JOIN
			`sde`.`TypesCours` ON `sde`.`TypesCours`.`idTypesCours` = `sde`.`Cours`.`TypesCours_idTypesCours`
		WHERE
			`sde`.`Cours`.`Enseignements_apogee` = p_apogee AND
			`sde`.`TypesCours`.`idTypesCours` = 1 AND
            `sde`.`Cours`.`annee` = p_annee
		;
	ELSE
		SELECT SUM(`sde`.`Cours`.`nbHeures`) INTO p_nbHeures
		FROM
			`sde`.`Cours`
		INNER JOIN
			`sde`.`TypesCours` ON `sde`.`TypesCours`.`idTypesCours` = `sde`.`Cours`.`TypesCours_idTypesCours`
		WHERE
			`sde`.`Cours`.`Enseignements_apogee` = p_apogee AND
			`sde`.`TypesCours`.`idTypesCours` = 2 AND
            `sde`.`Cours`.`annee` = p_annee
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
CREATE PROCEDURE `VerifierNbHCours` (IN p_apogee VARCHAR(45), IN p_nbHeures INT, IN p_typeCours INT, IN p_annee INT, OUT valide BOOLEAN)
BEGIN
	-- Déclarer variables
    DECLARE v_nbHDejaAffectee INT;
    DECLARE v_nbHTemp INT;
    DECLARE v_nbHTotal INT;
    -- Initialiser les variables
    -- Le nombre d'heure déjà affecté dans l'ensemble des cours existant de l'enseignement
	CALL CalculerNbHeuresAffectees(UPPER(p_apogee), p_typeCours, p_annee, v_nbHDejaAffectee);
    -- Selectionne le nombre d'heure de l'enseignement en fonction du typed
    If (p_typeCours = 1)
    THEN
		-- Selectionne la valeur du champ heureCM
		SELECT `sde`.`Enseignements`.`heureCM` INTO v_nbHTotal
		FROM `sde`.`Enseignements`
		WHERE `sde`.`Enseignements`.`apogee` = UPPER(p_apogee);
	ELSE
		-- Selectionne nbGroupe * heureTP
		SELECT `sde`.`Enseignements`.`heureTP` *  `sde`.`Enseignements`.`nbGroupes` INTO v_nbHTotal
		FROM `sde`.`Enseignements`
		WHERE `sde`.`Enseignements`.`apogee` = UPPER(p_apogee);
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
-- procedure SelectionnerEnseignements
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`SelectionnerEnseignements`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `SelectionnerEnseignements` ()
BEGIN
	SELECT
		`sde`.`Enseignements`.`apogee`,
		`sde`.`Enseignements`.`intitule`,
		CONCAT("S", `sde`.`Enseignements`.`semestre`) as semestre,
		`sde`.`Enseignements`.`heureCM`,
		`sde`.`Enseignements`.`heureTP`,
		`sde`.`Enseignements`.`nbGroupes`,
		`sde`.`Enseignements`.`heureTP`*`sde`.`Enseignements`.`nbGroupes`+`sde`.`Enseignements`.`heureCM` AS heureTotale,
		SUM(`CoursCM`.`heureAffecteCM`) AS heureAffecteCM,
		SUM(`CoursTP`.`heureAffecteTP`) AS heureAffecteTP,
		`sde`.`Formations`.`nom` AS formation,
		`sde`.`Diplomes`.`nom` AS diplome
	FROM
		`sde`.`Enseignements`
	INNER JOIN
		`sde`.`EnseignementsFormations` ON `sde`.`EnseignementsFormations`.`Enseignements_apogee` = `sde`.`Enseignements`.`apogee`
	INNER JOIN
		`sde`.`Formations` ON `sde`.`Formations`.`idFormations` = `sde`.`EnseignementsFormations`.`Formations_idFormations`
	INNER JOIN
		`sde`.`Diplomes` ON `sde`.`Diplomes`.`idDiplomes` = `sde`.`Formations`.`Diplomes_idDiplomes`

	-- Jointure sur une sous-requete pour avoir les cours de type TP (2)
	LEFT JOIN
		(
		  SELECT
			`nbHeures` AS heureAffecteTP,
			`Enseignements_apogee` AS CoursTP_Enseignements_apogee
		  FROM
			`sde`.`Cours` WHERE `sde`.`Cours`.`TypesCours_idTypesCours` = 2
		) AS `CoursTP`
		ON `CoursTP`.`CoursTP_Enseignements_apogee` = `sde`.`Enseignements`.`apogee`

	-- Jointure sur une sous-requete pour avoir les cours de type CM (1)
	LEFT JOIN
		(
		  SELECT
			`nbHeures` AS heureAffecteCM,
			`Enseignements_apogee` AS CoursCM_Enseignements_apogee
		  FROM
			`sde`.`Cours` WHERE `sde`.`Cours`.`TypesCours_idTypesCours` = 1
		) AS `CoursCM`
		ON `CoursCM`.`CoursCM_Enseignements_apogee` = `sde`.`Enseignements`.`apogee`
	GROUP BY
		`sde`.`Enseignements`.`apogee`
	;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure InsererEnseignant
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`InsererEnseignant`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE InsererEnseignant(IN p_nom VARCHAR(45), IN p_prenom VARCHAR(45), IN p_idStatuts INT, IN p_depEco INT)
BEGIN
    INSERT INTO `sde`.`Enseignants` (nom, prenom, Statuts_idStatuts, depEco)
    VALUES (UPPER(p_nom), UPPER(p_prenom), p_idStatuts, p_depEco);
END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure SelectionnerCours
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`SelectionnerCours`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `SelectionnerCours` (IN p_annee INT)
BEGIN
	SELECT * FROM `VueListeCours` WHERE `VueListeCours`.`annee` = p_annee;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure SelectionnerEnseignantsParEnseignement
-- -----------------------------------------------------

USE `sde`;
DROP procedure IF EXISTS `sde`.`SelectionnerEnseignantsParEnseignement`;

DELIMITER $$
USE `sde`$$
CREATE PROCEDURE `SelectionnerEnseignantsParEnseignement` (IN p_apogee INT)
BEGIN
SELECT *
    FROM VueListeCours
    WHERE `VueListeCours`.`apogee` = p_apogee
    GROUP BY `VueListeCours`.`idEnseignants`;
END$$

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
    if(`sde`.`Enseignants`.`depEco`, "SDE", "Hors SDE") AS Departement,
    if(`sde`.`Statuts`.`titulaire`, "Titulaire", "Non-Titulaire") AS Tituaire,
    `sde`.`Statuts`.`nom` AS Categorie,
    `sde`.`Statuts`.`titulaire` AS Titulaire,
    `sde`.`Statuts`.`heureService` AS HeuresDues,
    SUM(`sde`.`Cours`.`nbHeures`) AS HeuresAffectees
FROM
    `sde`.`Enseignants`
INNER JOIN
    `sde`.`Statuts` ON `sde`.`Statuts`.`idStatuts` = `sde`.`Enseignants`.`Statuts_idStatuts`
LEFT JOIN
	`sde`.`Cours` ON `sde`.`Cours`.`Enseignants_idEnseignants` = `sde`.`Enseignants`.`idEnseignants`
GROUP BY
	`sde`.`Enseignants`.`idEnseignants`
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
    `sde`.`Enseignements`.`nbGroupes`,
    `sde`.`Enseignements`.`heureTP`*`sde`.`Enseignements`.`nbGroupes`+`sde`.`Enseignements`.`heureCM` AS heureTotale,
    `sde`.`Enseignements`.`semestre`,
    `sde`.`Formations`.`nom` AS formation,
    `sde`.`Diplomes`.`nom` AS diplome
FROM
    `sde`.`Enseignements`
INNER JOIN
    `sde`.`EnseignementsFormations` ON `sde`.`EnseignementsFormations`.`Enseignements_apogee` = `sde`.`Enseignements`.`apogee`
INNER JOIN
    `sde`.`Formations` ON `sde`.`Formations`.`idFormations` = `sde`.`EnseignementsFormations`.`Formations_idFormations`
INNER JOIN
  	`sde`.`Diplomes` ON `sde`.`Diplomes`.`idDiplomes` = `sde`.`Formations`.`Diplomes_idDiplomes`
;

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
    `sde`.`Cours`.`annee` AS annee,
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
