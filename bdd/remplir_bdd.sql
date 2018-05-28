-- -----------------------------------------------------
-- Table TypeService
-- -----------------------------------------------------
insert into `sde`.`TypeService` (nom) values("CM");
insert into `sde`.`TypeService` (nom) values("TD");

-- -----------------------------------------------------
-- Table Statut
-- -----------------------------------------------------
insert into `sde`.`Statut`  (nom, heureService, titulaire)
values
    ("PR", 192, 1),
    ("MCF", 192, 1),
    ("PRAG", 384, 1),
    ("ATER", 96, 0),
    ("MONITEUR", 384, 0),
    ("EXTERIEUR", 0, 0);


-- -----------------------------------------------------
-- Table Enseignant
-- -----------------------------------------------------
insert into `sde`.`Enseignant`  (nom, prenom, depEco, statut_idStatut)
values
    ("DARMANGEAT", "CHRISTOPHE", 1, 3),
    ("GROUIEZ", "PASCALE", 1, 2),
    ("LAMARCHE", "THIERY", 1, 1),
    ("DOSQUET", "YVON", 1, 4),
    ("DUPONT EXTERIEUR", "JEAN", 0, 5),
    ("LERY", "JEAN-MICHEL", 0, 6);

-- -----------------------------------------------------
-- Table Diplome
-- -----------------------------------------------------
insert into `sde`.`Diplome` (nom)
values
    ("LICENCE"),
    ("MASTER");

-- -----------------------------------------------------
-- Table Formation
-- -----------------------------------------------------
insert into `sde`.`Formation` (nom, Diplome_idDiplome)
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
-- Table Enseignement
-- -----------------------------------------------------
insert into `sde`.`Enseignement` (apogee, intitule, heureCM, heureTP, semestre, nbGroupes)
values
    ("43IF5044", "Stratégie d'entreprise et système d'info", 27, 0, 9, 1),
    ("43IF5073", "Algorithmique", 48, 0, 9, 1),
    ("43IF5084", "C#", 40, 0, 10, 1),
    ("43QE1443", "Economie servicielle", 24, 0, 10, 1),
    ("54AEE1EC", "Introduction à l'économie", 50, 18, 5, 2);

-- -----------------------------------------------------
-- Table EnseignementsFormation
-- -----------------------------------------------------
insert into `sde`.`EnseignementFormation` (Formation_idFormation, Enseignement_apogee)
values
    (6, "43IF5044"),
    (6, "43IF5073"),
    (6, "43IF5084"),
    (1, "43QE1443"),
    (1, "54AEE1EC");

-- -----------------------------------------------------
-- Table Service
-- -----------------------------------------------------
insert into `sde`.`Service` (Enseignant_idEnseignant, TypeService_idTypeService, annee, Enseignement_apogee, nbHeures)
values
    (1, 1, 2018, "54AEE1EC", 10),
    (2, 1, 2018, "54AEE1EC", 15),
    (3, 1, 2018, "54AEE1EC", 5),
    (1, 2, 2018, "54AEE1EC", 9),
    (2, 2, 2018, "54AEE1EC", 9),
    (2, 2, 2018, "54AEE1EC", 9),
    (4, 1, 2018, "43QE1443", 20);
    -- (1, 1, 2018, "43IF5073", 48),
    -- (1, 1, 2018, "43IF5084", 20),
    -- (3, 1, 2018, "43QE1443", 24),
    -- (2, 1, 2018, "43IF5044", 21),
    -- (3, 1, 2018, "43IF5044", 6);
