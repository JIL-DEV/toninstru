# TonInstru
Site permettant aux musiciens de vendre ou d'acheter des instruments.

### Installation 
- Copier le fichier **.env-example** dans un nouveau fichier **.env** 
- Configurer le fichier **.env**
- Lancer la commande pour installer les services  
    `make build`
- Mettre a jour Composer  
    `composer install`
- Lancer la commande permettant de se connecter au container  
    `make connect`
- Mettre a jour la base de donnée  
    `php bin/console make:migration`  
    `php bin/console doctrine:migration:migrate`

### Outils & Technologies
Le site a été réalisé avec les outils & technologies suivantes :

- HTML/CSS
- PHP/Symfony 5
- JQuery
- Bootstrap
- MySQL
- Docker
- Git

### Commandes Docker
Des commandes ont été enregistrer dans le Makefile.

- Installer et Lancer les services  
    `make build`
      
- Lancer les services  
    `make run`

- Arrêter les services  
    `make down`
    
- Se connecter au container  
    `make connect`
    
### Gestion GIT
Voici quelque règles pour la gestion du GIT pour les développeurs.
- Toutes les branches doivent partir de la branche **dev**.
- Les noms de branches doit correspondre au nom de la fonctionnalité qui sera développé.
- Les noms de branches devront commencer par **feat/**.
- Les merges requests seront destinée vers la branche **dev** 

La branche **master** contiendra **uniquement** les versions stables du projet.


S'il a des soucis n'hésitez pas à me contacter.