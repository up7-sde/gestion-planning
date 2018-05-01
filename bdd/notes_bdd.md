# Notes BDD

> Présente l'écritue de la BDD

## Workflow

Ecrire le MCD sur JMerise. Ensuite reporter le MLD sur MysqlWorkbench pour :
- générer le script (il y a beaucoup plus d'options que sur JMerise)
- et accessoirement exporter le MLD (le rendu graphique est nettement plus lisible !)

## Modélisation

### Relation de reflexivité dans Catégories
On pourrait distinguer le statut (PR, MCF, etc.) et la catégorie des enseignant dans deux tables. Pourtant un enseignant tituliare du département (catégorie 1) ne pourra être que du status PR, MCF, PAST, PRAG et pas ATER ou Moniteur. En utilisat une relation de reflexivité on regroupe les deux informations dans une seule table. On a un système à tiroir avec au premier niveau les catégories qui pourront (ou pas pour les non-titulaires) faire référence à un deuxième niveau : les statuts. Ainsi on cloisonne les statuts dans des catégories.

### Relation tripates et entité Cours
Les Enseignements sont découpés en cours (morceau d'enseignements), voir si ça ne correspond pas plutot à une relation tripates.

### Groupe et CMTD
Le nombre total d'heure d'un enseignement sera directement calculé avec :
CM + nbGroupe * TD

### code APOGEE/ECUE
Dans le CDC il est fait référence au CDC pour identifier un enseignement mais dans le tableau excel le terme ECUE est utilisé : est-ce qu'il s'agit de la même chose ?

## Les vues
L'idée consiste à limiter les droits du schéma applicatif à des SELECT sur 3 VIEWS prédéfinies :

- liste des enseignants :
    - Enseignants.nom
    - Enseignants.prenom
    - Categories.nom
    - Categories.heureService
    - nb de cours (à calculer)
- liste des enseignements :
    - Enseignements.apoge
    - Enseignements.intitule
    - Enseignements.heureCM
    - Enseignements.heureeTP
    - Enseignements.semestre
    - Enseignements.nbGroupes
    - Formations.nom
    - Formations.diplome
- La liste des cours (a filtrer par enseignant pour avoir le détail de ses cours ou par enseignements pour le détail des enseignements) :
    - Enseignements.apogee
    - Enseignement.intitule,
    - TypesCours.nomC
    - Cours.nbHeure
    - Cours.annee (pour filtrer sur une année)

> Les vues sont préfixé par "Vue" : VueListeEnseignants

## Procédures

Afin d'améliorer la sécurité ET les performances on utilisera des **procédures**. Allez voir le petit rappel sur les procédure en MySQL sur [openclassroom](https://openclassrooms.com/courses/administrez-vos-bases-de-donnees-avec-mysql/procedures-stockees).

On aura besoin des procédures :

- ajouter : un Enseignants, Enseignements, Cours, Formations **FAIT**
- modifier : un Enseignants, Enseignements, Cours, Formations **UPDATE de l'ensemble des champs!**
- supprimer : un cours

> Dans le script les paramètres des procédure sont préfixées pas un p

## A faire :
- extraire diplome de la table Formation (créer une entité Diplome)
- revoir les droits
