-- petit script pour faire des tests pendant l'ecriture des procédures
CALL InsererEnseignant("Jean", "Louis", 1, 1);
CALL InsererEnseignement("BLOB", "Introduction à la biogeographie", 26, 18, 5, 1, 1);
-- Insérer une série de cours (TD puis CM qui dont les 2 ou 3 premiers seulement doivent passer)
CALL InsererService(1, 2, 1999, "54AEE1EC", 6);
CALL InsererService(1, 2, 1998, "54AEE1EC", 6);
CALL InsererService(1, 2, 1997, "54AEE1EC", 6);
CALL InsererService(1, 2, 1996, "54AEE1EC", 6);
CALL InsererService(1, 2, 1995, "54AEE1EC", 6);
CALL InsererService(1, 1, 2009, "54AEE1EC", 7);
CALL InsererService(1, 1, 2018, "54AEE1EC", 7);
CALL InsererService(1, 1, 2014, "54AEE1EC", 7);
CALL InsererService(1, 1, 2013, "54AEE1EC", 7);
CALL InsererService(1, 1, 2012, "54AEE1EC", 7);
CALL InsererService(1, 1, 2011, "54AEE1EC", 7);
CALL InsererService(1, 1, 2010, "54AEE1EC", 7);
-- Modifier une série de cours dont les 2 ou 3 premiers seulement doivent passer
CALL ModifierService(1, 1, 1, 1800, "54AEE1EC", 2);
CALL ModifierService(1, 1, 1, 1800, "54AEE1EC", 5);
CALL ModifierService(1, 1, 1, 1800, "54AEE1EC", 15);
CALL ModifierService(1, 1, 1, 1800, "54AEE1EC", 60);
CALL InsererFormation("EDMR", 1);
CALL ModifierEnseignant(1, "Jean", "DarmanGeaT", 1);
CALL ModifierEnseignement("ZEFIJZIEJF", "BLOB", "Un cours chouette sur les blobs", 12, 13, 5, 3);
CALL ModifierFormation("PISE", "PAAASE", 2);
CALL SupprimerService(2);
