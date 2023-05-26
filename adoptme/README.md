# adoptme

Adoptme es una aplicación web, pensada para ....

Ha sido desarrollado separando back de front:

Database:
    
- Mariadb como motor de BBDD.

PHPMyAdmin:
    
- Cliente web para para gestiornar BBDD.

Back:
    
- Basado en nodejs XXXX como motor y framework;
    
- Express JS como framework para API REST.

Web app:
    
- Aplicación web en php8.1-fpm

Server:
    
- Servidor web Nginx

Docker:
    
- Se ha optado por docker para compilar todos los servicios de modo que sea fácil el montaje del entorno y ecosistema.


Para poder ejecutar el entorno en local, hay que disponer de docker previamente instalado: https://www.docker.com/

Una vez ya con docker en ejecución, hay que lanzar el siguiente comando en la terminal:

    docker-compose up -d

Cuando finalice completamente, podremos acceder a los distintos servicios.

Web app: http://localhost:8080

PHPMyAdmin: http://localhost:8081

backend Api Rest : http://localhost:3000