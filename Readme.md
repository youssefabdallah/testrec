1- composer create-project symfony/website-skeleton testrec 5.4\*

2 - pour l'authentification on a utilisé le module Security de symfony
il est facile à implémenter et on peut le personnaliser

#le guide d'installation
1- cd docker
2- docker-compose build
3- docker-compose up -d
4- docker exec -it php bash
5- php bin/console doctrine:database:create
6- php bin/console make:migration
7- php bin/console doctrine:migrations:migrate
8- php bin/console app:create-user <email> <password>

vous pouvez acceder a l'interface phpmyadmin via
host = http://localhost:8081/
user = root
password = secret

#la dockerisation de l'application
1- pour php je recommende l'image php-fpm
2- pour le serveur web je recommande l'image de nginx-alpine
3- pour la base de données je recommande mysql:8.0 (LTS)
4- en cas de besoin d'une interface phpmyadmin je recommande l'image de phpmyadmin
