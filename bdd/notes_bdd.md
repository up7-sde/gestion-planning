# Notes BDD

> Présente l'écritue de la BDD

## Workflow

Ecrire le MCD sur JMerise. Ensuite reporter le MLD sur MysqlWorkbench pour :
- générer le script (il y a beaucoup plus d'options que sur JMerise)
- et accessoirement exporter le MLD (le rendu graphique est nettement plus lisible !)

## Modélisation

### Entité Statuts

L'ensemble des combinaisons possible (titulaire / non titulaire, departement / hors département, et les status) peut être stocker dans une entité Statuts (nom, heureService, titulaire (bool)) et e champ depEco (bool) dans l'Entité Enseignant

**Relation de reflexivité dans l'entité Statuts**

On pourrait distinguer le statut (PR, MCF, etc.) et la catégorie des enseignant dans une seule table avec  une relation de reflexivité on regroupe les deux information dans une seule table. On a un système à tiroir avec au premier niveau les catégories qui pourront (ou pas pour les TITULAIRE HORS DEPARTEMENT et les EXTERIEUR) faire référence à un deuxième niveau : les statuts. Ainsi on cloisonne les statuts dans des catégories.

Voir cet [article](http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql/)

### Service
Plus petites granulométrie. Cette entité à un sens plus large que les cours d'un enseignements car on peut avoir des services déconnecté d'un enseignement (service lié à une activité de syndicat par exemple).

### Groupe et CMTD
Le nombre total d'heure d'un enseignement sera directement calculé avec :
CM + nbGroupe * TD

### code APOGEE/ECUE
Dans le CDC il est fait référence au CDC pour identifier un enseignement mais dans le tableau excel le terme ECUE est utilisé : est-ce qu'il s'agit de la même chose ?

## Les vues
4 VIEWS prédéfinies qui correspondent toutes à des formatages d'une listes des services groupé par

- formation
- Enseignant
- Enseignement
- rien (tous les services)
> Les vues sont préfixé par "Vue" : VueListeEnseignant, etc.

## Procédures

Allez voir le petit rappel sur les procédure en MySQL sur [openclassroom](https://openclassrooms.com/courses/administrez-vos-bases-de-donnees-avec-mysql/procedures-stockees).

On aura besoin des procédures "métier":

- ajouter : un Enseignant, Enseignement, Service, Formation
- modifier : un Enseignant, Enseignement, Service, Formation (UPDATE sur l'ensemble des champs)
- supprimer : un cours. Et c'est tout car sinon on va devoir gérer énormément de CASCADE pour les Enseignant, Enseignement et Formation.

et de procédures d'"administration":
- modifier les catégories (nom, nb d'heure)
- attention on ne pourra pas modifier TypesService, car bcp de procédures repose sur le fait que TypesService 1 vaut CM et 2 vaut TP

Ces procédures reposeront sur des procédures de controle :

- Les procédures InsererService et ModifierService utilisent VeérifierNbHService et CalculerNbHeuresAffectees permettent de vérifier qu'on ne va pas créer un cours qui rendrait le total des heures de cours d'un enseignement supérieur à son champ nbHeure (les procédures gèrent les deux type de Services TD et CM et sont utilisé pour). **Attention**, ces procédure repose sur le fait que les enregistrement CM et TP dans la tables TypesService ont pour id respectif 1 et 2 !

> Dans le script les paramètres des procédures sont préfixées pas un p

## Contraint check

Ajouter des contraintes de types check pour s'assurer que les données sont cohérente.

Forme :

  CREATE TABLE WhatEver
  (
      ...
      NumericField INTEGER NOT NULL CHECK(NumericField BETWEEN 1234 AND 4523),
      ...
  );

Exemple :
- semestre de 1 à 6 max pour un Enseignement de type licence ou de 1 à 4 pour un enseignement de type master.

## Sécurité

Afin d'améliorer la sécurité ET les performances on utilisera des **procédures** et des **vues**. Il faudra limiter les droits des comptes applicatif à des select les vues et des call sur les procédures.

On aura 2 users :

- admin (avec des droits sur les vues ET les procédures)
- enseignant (avec des droits sur les vues uniquement)

Cette séparation suit la logique au niveau de l'application
