-- petit script pour faire des tests pendant l'ecriture des procédures
CALL InsererEnseignant("Jean", "Louis", 1);
CALL InsererEnseignement("54AEe3EC", "Introduction à la biogeographie", 26, 18, 5, 1);
CALL InsererCours(1, 2, 2018, "54AEe3EC", 18);
CALL InsererFormation("EDMR", 1);
CALL ModifierEnseignant(1, "Jean", "DarmanGeaT", 1);
CALL ModifierCours(1, 1, 1, 2018, "54AEE1EC", 15);
CALL ModifierEnseignement("43IF5073", "BLOB", "Un cours chouette sur les blobs", 12, 13, 5, 3);
CALL ModifierFormation("PISE", "PAAASE", 2);
CALL SupprimerCours(2);

-- CALL calculerNbHeureCMAffecte("43IF5084");