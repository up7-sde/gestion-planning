-- -----------------------------------------------------
-- Table TypesCours
-- -----------------------------------------------------
insert into `sde`.`TypesCours` (nom) values("CM");
insert into `sde`.`TypesCours` (nom) values("TD");

-- -----------------------------------------------------
-- Table Categories
-- -----------------------------------------------------
-- niveau 1
insert into `sde`.`Categories` (nom)
values
    ("TITULAIRE"),
    ("NON-TITULAIRE RATTACHE"),
    ("TITULAIRE HORS DEPARTEMENT"),
    ("CHARGE ENSEIGNEMENTS EXTERIEUR");

-- niveau 2 (tps à modifier pour ater et prag)
insert into `sde`.`Categories` (nom, heureService, Categories_idCategories)
values
    ("PR", 192, 1),
    ("MCF", 192, 1),
    ("PRAG", 384, 1),
    ("PAST", 96, 2),
    ("ATER", 192, 2),
    ("DEMI-ATER", 96, 2),
    ("MONITEUR", 384, 2);

-- -----------------------------------------------------
-- Table Enseignants
-- -----------------------------------------------------
insert into `sde`.`Enseignants`  (nom, prenom, Categories_idCategories)
values
    ("DARMANGEAT", "CHRISTOPHE", 8),
    ("GROUIEZ", "PASCALE", 6),
    ("LAMARCHE", "THIERY", 5),
    ("DOSQUET", "YVON", 3);

-- -----------------------------------------------------
-- Table Diplomes
-- -----------------------------------------------------
insert into `sde`.`Diplomes` (nom)
values
    ("LICENCE"),
    ("MASTER");

-- -----------------------------------------------------
-- Table Formations
-- -----------------------------------------------------
insert into `sde`.`Formations` (nom, Diplomes_idDiplomes)
values
    ("ECONOMIE", 1),
    ("MIASHS", 1),
    ("MECI", 2),
    ("CCESE", 2),
    ("IADL", 2),
    ("PISE", 2),
    ("E2S", 2),
    ("EPOG", 2),
    ("APE", 2),
    ("ILTS", 2);

-- -----------------------------------------------------
-- Table Enseignements
-- -----------------------------------------------------
insert into `sde`.`Enseignements` (apogee, intitule, heureCM, heureTP, semestre, nbGroupes)
values
    ("43IF5044", "Stratégie d'entreprise et système d'info", 27, 0, 9, 1),
    ("43IF5073", "Algorithmique", 48, 0, 9, 1),
    ("43IF5084", "C#", 40, 0, 10, 1),
    ("43QE1443", "Economie servicielle", 24, 0, 10, 1),
    ("54AEE1EC", "Introduction à l'économie", 50, 18, 5, 1);

-- -----------------------------------------------------
-- Table EnseignementsFormations
-- -----------------------------------------------------
insert into `sde`.`EnseignementsFormations` (Formations_idFormations, Enseignements_apogee)
values
    (6, "43IF5044"),
    (6, "43IF5073"),
    (6, "43IF5084"),
    (4, "43QE1443"),
    (1, "54AEE1EC");

-- -----------------------------------------------------
-- Table Cours
-- -----------------------------------------------------
insert into `sde`.`Cours` (Enseignants_idEnseignants, TypesCours_idTypesCours, annee, Enseignements_apogee, nbHeures)
values
    (1, 1, 2018, "54AEE1EC", 10),
    (1, 1, 2018, "54AEE1EC", 15),
    (1, 1, 2018, "54AEE1EC", 5),
    (1, 2, 2018, "43QE1443", 2),
    (1, 2, 2018, "43QE1443", 7);
    -- (1, 1, 2018, "43IF5073", 48),
    -- (1, 1, 2018, "43IF5084", 20),
    -- (3, 1, 2018, "43QE1443", 24),
    -- (2, 1, 2018, "43IF5044", 21),
    -- (3, 1, 2018, "43IF5044", 6);
