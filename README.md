# gestion-planning
Projet réalisé dans le cadre du cours de langage PHP du master PISE.


> Documente l'écriture du programme : les problèmes rencontrés, les choix faits par thématique (base de données, mise en production, etc.)

## Base de données

### Les tables

La base de données repose sur 5 tables métiers :

- Formation
- Enseignement
- Enseignant
- Service

des tables pour les référentiels :

- Types de Cours
- Diplômes
- Statut Enseignant

et la table utilisateur pour la gestion des utilisateur du site web.

### Sécurité : comptes et procédures

Pour améliorer la sécurité l'application aura accès à 2 comptes :

- enseignant (globalement ne peut que consulter)
- admin (peut consulter et éditer, il gère également les utilisateurs)

Par ailleurs ces comptes on des droits sur des procédures qui correspondent aux actions métiers : modifier/ajouter/supprimer des enseignants/enseignements/formations/services.

### Les vues

Du point de vu de l'application les formations, enseignements et enseignants reposent sur des vues. Ces vues sont en fait des regroupements des services (ou cours). Cela permet d'avoir les tableaux avec le nombre d'heures affectées, le nombre d'heure de TP/TD, etc. par entité (formation, enseignement, cours).

## La mise en production

Le site est hebergé sur un serveur de [digitalocean](https://www.digitalocean.com/), en suivant les étapes suivantes :

### Installer et Apache2

    # Update et Installer apache2
    sudo apt-get update
    sudo apt-get install -y apache2

### Installer Mysql

    # Update et installer mysql
    sudo apt-get update
    sudo apt-get install mysql-server


### Configurer mysql pour [améliorer la sécurité des mdp](https://www.howtoforge.com/setting-changing-resetting-mysql-root-passwords)

    mysql_secure_installation

### Installer [PHP 7.1](https://www.vultr.com/docs/how-to-install-and-configure-php-70-or-php-71-on-ubuntu-16-04)

    # Ajouter les sources des packages pour php 7
    sudo apt-get install -y python-software-properties
    sudo add-apt-repository -y ppa:ondrej/php
    sudo apt-get update -y

    # Installer php7
    sudo apt-get install -y php7.1 libapache2-mod-php7.1 php7.1-cli php7.1-common php7.1-mbstring php7.1-gd php7.1-intl php7.1-xml php7.1-mysql php7.1-mcrypt php7.1-zip

### Configurer Apache2


    # Faire une copie du fichier de configuration
    cp /etc/apache2/apache2.conf /etc/apache2/apache2.conf.ori20180508
    # Ajouter le nom du server
    echo "ServerName IP_OU_DOMANE" >> /etc/apache2/apache2.conf
    # Autoriser l'accès web sur le server
    sudo ufw allow in "Apache Full"
    # Ajouter la recherche d'un fichier index.php lors de l'ouverture d'un dossier
    cp /etc/apache2/mods-enabled/dir.conf  /etc/apache2/mods-enabled/dir.conf.ori20180508
    sudo vim /etc/apache2/mods-enabled/dir.conf


    # Changer le fichier en :
    <IfModule mod_dir.c>
        DirectoryIndex **index.php** index.html index.cgi index.pl index.xhtml index.htm
    </IfModule>

    # Relancer le serveur pour prendre en compte les changements
    sudo systemctl restart apache2

###  Créer l'arborescence et configurer le VirtualHost

    # Ajouter un utilisateur dédié
    adduser sde
    # entrer le password
    mkdir -p /home/sde/sites/sde
    # Ajouter un fichier test dans un dossier dédié à contenir le code du site sde
    touch /home/sde/sites/sde/index.html
    echo "hello world" > /home/sde/sites/sde/index.html

    # Ajouter un lien vers le dossier /home/sde/sites/sde/web
    cd /var/www
    ln -s /home/sde/sites/sde/web sde

    # Créer le VH
    sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/sde.conf
    vim /etc/apache2/sites-available/sde.conf

    # Faire pointer le virtualHost sur le lien "/var/www/sde"

    ```
        <VirtualHost *:80>
                #ServerName www.example.com

                ServerAdmin remidlnn@gmail.com
                DocumentRoot /var/www/sde

                ErrorLog ${APACHE_LOG_DIR}/error.log
                CustomLog ${APACHE_LOG_DIR}/access.log combined

        </VirtualHost>
    ```
    # Mettre en fonctionnement le site et éteindre celui par défaut
    a2dissite 000-default.conf
    a2ensite sde.conf
    service apache2 reload


## Installation de l'application en local sur un Xampp

Lancer le script de création de la base de données `bdd/creer_bdd.sql` avec le compte root

```
/opt/lampp/bin/mysql -u root -p < chemin/vers/bdd/creer_bdd.sql
```

Afin de permettre l'utilisation de la fonction php getenv(), il faut ajouter les variables d'environnement dans le fichier de configuration pour qu'au lancement Apache est ces variables configurées. Ajouter à la fin du fichier `/opt/lampp/apache2/conf/httpd.conf` :

```
SetEnv ADMIN_MYSQL_PASSWD "mdpadmin"
SetEnv BDD_NOM sde
SetEnv ADMIN_MYSQL_LOGIN admin
SetEnv ENSEIGNANT_MYSQL_LOGIN enseignant
SetEnv ENSEIGNANT_MYSQL_PASSWD mdpenseignant

```

Enfin il faut ajouter le lien vers le projet :

```
cd /opt/lampp/htdocs
sudo ln -s /chemin/vers/projet/web/ web
```

## Test non regression

Le fichier `test\SCENARIO-SDE-UP7-XX` contient un scénario de test de non regression es principales fonctionnalités du site.

Utilisation :

- Télécharger l'addon katalon (sur [firefox](https://addons.mozilla.org/en-US/firefox/addon/katalon-automation-record/))
- Lancer l'add-on et ouvrir le fichier avec.

**A noter** :
Ouvrir le navigateur en plein écran lors du lancement du test et utiliser firefox (katalon existe aussi sur chrome mais ça ne fonctionnera pas nécessairement).
