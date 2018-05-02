-- petit script pour faire des tests pendant l'ecriture des procédures
CALL InsererEnseignant("Jean", "Louis", 1);
CALL InsererEnseignement("54AEe3EC", "Introduction à la biogeographie", 26, 18, 5, 1);
-- 2016 devra s'afficher pas 2015 (a cause du nombmre d'heure)
CALL InsererCours(1, 1, 2015, "54AEE1EC", 320);
CALL InsererCours(1, 1, 2018, "54AEE1EC", 7);
CALL InsererCours(1, 1, 2014, "54AEE1EC", 7);
CALL InsererCours(1, 1, 2013, "54AEE1EC", 7);
CALL InsererCours(1, 1, 2012, "54AEE1EC", 7);
CALL InsererCours(1, 1, 2011, "54AEE1EC", 7);
CALL InsererCours(1, 1, 2010, "54AEE1EC", 7);
CALL InsererCours(1, 1, 2009, "54AEE1EC", 7);
CALL InsererFormation("EDMR", 1);
CALL ModifierEnseignant(1, "Jean", "DarmanGeaT", 1);
-- CALL ModifierCours(1, 1, 1, 2016, "54AEE1EC", 15);
CALL ModifierEnseignement("43IF5073", "BLOB", "Un cours chouette sur les blobs", 12, 13, 5, 3);
CALL ModifierFormation("PISE", "PAAASE", 2);
CALL SupprimerCours(2);

-- CALL calculerNbHeureCMAffecte("43IF5084");
