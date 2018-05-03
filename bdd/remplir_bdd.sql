-- -----------------------------------------------------
-- Table TypesCours
-- -----------------------------------------------------
insert into `sde`.`TypesCours` (nom) values("CM");
insert into `sde`.`TypesCours` (nom) values("TD");

-- -----------------------------------------------------
-- Table Categories
-- -----------------------------------------------------
-- niveau 0 (obligé d'avoir un noeud de départ)
insert into `sde`.`Categories` (nom)
  values ("ENSEIGNANT");
-- niveau 1 catégorie
insert into `sde`.`Categories` (nom, Categories_idCategories)
values
    ("TITULAIRE", 1),
    ("NON-TITULAIRE RATTACHE", 1),
    ("TITULAIRE HORS DEPARTEMENT", 1),
    ("CHARGE ENSEIGNEMENTS EXTERIEUR", 1);

-- niveau 2 statut (tps à modifier pour ater et prag)
insert into `sde`.`Categories` (nom, heureService, Categories_idCategories)
values
    ("PR", 192, (SELECT idCategories FROM Categories AS toto WHERE toto.nom = "TITULAIRE")),
    ("MCF", 192, 2),
    ("PRAG", 384, 2),
    ("PAST", 96, 3),
    ("ATER", 192, 3),
    ("DEMI-ATER", 96, 3),
    ("MONITEUR", 384, 3);

-- -----------------------------------------------------
-- Table Enseignants
-- -----------------------------------------------------
insert into `sde`.`Enseignants`  (nom, prenom, Categories_idCategories)
values
    ("DARMANGEAT", "CHRISTOPHE", 7),
    ("GROUIEZ", "PASCALE", 6),
    ("LAMARCHE", "THIERY", 5),
    ("DOSQUET", "YVON", 4),
    ("DUPONT EXTERIEUR", "JEAN", 4),
    ("DUPONT PAST", "JEAN", 4);

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
