/* Tester les procédures */

-- Se connecter à la base de données
use sde

-- Sur la table enseignant
CALL InsererEnseignant("Jean", "INSERER", 1, 1);
CALL ModifierEnseignant(1, "Jean", "modifier", 1, 0);
CALL SupprimerEnseignant(7);

-- Sur la table Enseignement
CALL InsererEnseignement("BLOB", "Insérer", 26, 18, 5, 1, 1);
CALL ModifierEnseignement("43IF5084", "TOTO", "modifier", 12, 13, 5, 3, 1);
CALL SupprimerEnseignement(6);

-- Sur la table Service
CALL InsererService(1, 2, 1789, "54AEE1EC", 6);
CALL ModifierService(2, 1, 1, 1789, "54AEE1EC", 5);
CALL SupprimerService(11);

-- Sur la table Formation
CALL InsererFormation("INSERER", 1);
CALL ModifierFormation(6, "modifier", 2);
CALL SupprimerFormation(10);

-- Sur la table Diplome
CALL InsererDiplome("INSERER");
CALL ModifierDiplome(1, "MODIFIER");
CALL SupprimerDiplome(3);

-- Sur la table TypeService
CALL InsererTypeService("INSERER");
CALL ModifierTypeService(1, "BLOB"); -- doit échouer
CALL SupprimerTypeService(2); -- doit échouer
CALL ModifierTypeService(4, "MODIFIER");
CALL SupprimerTypeService(3);

-- Sur la table Statut
CALL InsererStatut("INSERER", 122, 1);
CALL ModifierStatut(7, "modifier", 111, 0);
CALL SupprimerStatut(8);
