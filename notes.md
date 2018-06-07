# Notes générales

> Documente l'écriture du programme, liste tous les problèmes rencontrés avec les solutions apportées et les question à poser à Christophe

## Installation de l'environnement de travail

- Voir s'il est possible de connecter MySQL Workbench sur le mysql de xampp ?


## Apache 2

## Variable d'environnement

Pour pouvoir utiliser getenv() il faut ajouter les variables d'environnement dans un fichier de conf qui est utilisé à apache lorsqu'il lance php. Ajouter les variable à la fin du fichier `/opt/lampp/apache2`

En production il faudra les ajouter dans le fichier de conf du VH.

## PHP

### Cookie / Session

Rappel sur les cookies et session sur le site d'[openclassroom](https://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql/session-cookies)

### Formulaire

Les formulaires sont découpés par champ. Chaque controleur appelant une vue Form devra donc vérifier qu'il envoit les données nécessaire (idEnseignant, apogee, etc.)

## Questions CHRISTOPHE

- type de cours CM TP et CMTD, a quoi correspond CMTD et quelle est leur valeur ??
- est-ce que la partie "front office" signifie que chaque enseingnant à son login/mdp et ne peut voir que ses infos ? Ou bien c'est un login/mdp générique qui permet seulement de consulté l'ensemble des items (enseignement/service/...)
- notion de groupe sert à quoi exactement  ? Est-ce que le nombre de groupe varie en fonction des années (au quel cas il faut soit sortir le champ groupe de la table enseignement soit lui ajouter une année...). Sinon on pourrait déduire le nombre de groupe en fonction des services qui y sont rattaché ? 
- ajouter un champ commentaire dans la table Service (pour documenter les cas compliqué)


## Fonctionnalités :

- Copier/coller cours d'une année sur l'autre : le traitement sera fait dans PHP avec un appel de la procédure InsererCours(annee) sur un ensemble de cours
