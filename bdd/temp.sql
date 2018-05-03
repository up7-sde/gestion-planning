-- TEST VUE ENSEIGNANTS
SELECT
    `sde`.`Enseignants`.`nom`,
    `sde`.`Enseignants`.`prenom`,
    `Statut`.`nom` AS Statut,
    SUM(`sde`.`Cours`.`nbHeures`) AS HeuresAffectees
FROM
    `sde`.`Enseignants`
LEFT JOIN
    `sde`.`Cours` ON `sde`.`Cours`.`Enseignants_idEnseignants` = `sde`.`Enseignants`.`idEnseignants`
LEFT JOIN
    `sde`.`Categories` AS `Statut` ON `Statut`.`idCategories` = `sde`.`Enseignants`.`Categories_idCategories`
GROUP BY
    `sde`.`Enseignants`.`idEnseignants`

-- OBTENIR LE NIVEAU DES CATEGORIES
SELECT Categorie.nom AS Categorie
FROM `sde`.`Categories` AS racine
LEFT JOIN `sde`.`Categories` AS Categorie ON Categorie.Categories_idCategories = racine.idCategories
WHERE racine.nom = "ENSEIGNANT"

-- OBTENIR LE NIVEAU DES STATUTS
SELECT Statut.nom
FROM Categories AS Statut
LEFT JOIN Categories as enfant ON Statut.idCategories = enfant.Categories_idCategories
LEFT JOIN Categories as parent ON Statut.Categories_idCategories = parent.idCategories
WHERE enfant.idCategories IS NULL AND parent.nom != "ENSEIGNANT"
;

-- OBTENIR L'ENSEMBLE DE L'ARBRE
SELECT cat1.nom AS lev1, cat2.nom AS lev2, cat3.nom AS lev3
FROM `sde`.`Categories` AS cat1
LEFT JOIN `sde`.`Categories` AS cat2 ON cat2.Categories_idCategories = cat1.idCategories
LEFT JOIN `sde`.`Categories` AS cat3 ON cat3.Categories_idCategories = cat2.idCategories
WHERE cat1.nom = "ENSEIGNANT"

-- OBTENIR LES FEUILLES (catégories sans enfants)
SELECT t1.nom
FROM Categories AS t1
LEFT JOIN Categories as t2 ON t1.idCategories = t2.Categories_idCategories
WHERE t2.idCategories IS NULL;

-- SELECT t1.name FROM
-- category AS t1 LEFT JOIN category as t2
-- ON t1.category_id = t2.parent
-- WHERE t2.category_id IS NULL;
