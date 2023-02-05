# Imagen de dockerhub
FROM php:8.1.0-apache-buster

RUN a2enmod rewrite

# Instalacion de laravel y sus dependencias
RUN apt-get update && apt-get install -y \
        zlib1g-dev \
        libicu-dev \
        libxml2-dev \
        libpq-dev \
        libzip-dev
        #&& docker-php-ext-install pdo pdo_mysql zip intl xmlrpc soap opcache \
        #&& docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd


RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && docker-php-ext-install pdo_pgsql pgsql

RUN apt-get update -y

# RUN apt-get install npm

# Instalacion de node 8
RUN curl -sL https://deb.nodesource.com/setup_8.x -o /tmp/nodesource_setup.sh| bash -- \
	&& apt-get install -y nodejs \
	&& apt-get autoremove -y

#Instalacion composer (Instalar composer manualmente dentro de un docker es un infierno, por lo cual, cogemos la carpeta composer de una imagen oficial y la copiamos a nuestro docker)
COPY --from=composer /usr/bin/composer /usr/bin/composer

#Quiza no son necesarios
#COPY  docker/000-default.conf /etc/apache2/sites-available/000-default.conf

#Aqui va el archivo .env de laravel
#COPY  docker/.env /var/www/html/public/.env
#COPY  docker/php.ini /usr/local/etc/php/php.ini

ENV COMPOSER_ALLOW_SUPERUSER 1

#Descargamos GIT y Cambiamos de directorio
RUN apt update && apt install -y git 
WORKDIR /var/www/html
#Variable Para Repositorio GIT
ENV GIT_LINK=https://github.com/ArkaitzTX/Erronka2.git
ENV GIT_REP=development
#Clonación del repositorio GIT
RUN git clone -b ${GIT_REP} ${GIT_LINK} .
#Cambio de Permisos
RUN chown -R www-data:www-data /var/www/html

#Variable de ruta de documento index
ENV APACHE_DOCUMENT_ROOT=/var/www/html/Erronka/public
#Reemplazar ruta predeterminada de todas las configuraciones apache2
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
#Ajuste de BD, Local a Docker (Laravel y PHP)
RUN sed -ri -e 's!DB_HOST=127.0.0.1!DB_HOST=db!g' /var/www/html/Erronka/.env
RUN sed -ri -e 's!DB_PASSWORD=!DB_PASSWORD=Inf041!g' /var/www/html/Erronka/.env
RUN sed -ri -e 's!127.0.0.1!db!g' /var/www/html/Erronka/public/PHP/update.php
RUN sed -ri -e "s!$contrasenyaDB = ''!$contrasenyaDB = 'Inf041'!g" /var/www/html/Erronka/public/PHP/update.php
#(Opcional) Instalación de NPM y SASS
RUN apt-get install -y npm 
RUN npm install -g sass 


# ENV APACHE_DOCUMENT_ROOT=/var/www/html/Chemistry-Room/public/web
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
# RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
# RUN cd /var/www/html/Chemistry-Room/public/CSS
# RUN sass --watch style.scss style.css


#COPY  . /var/www/html/
#WORKDIR /var/www/html/

#Damos permisos al usuario y grupo www-data (propios de la version php:7.4-apache) en la carpeta donde vamos a copiar el proyecto
#RUN chown -R www-data:www-data /var/www/html  \
#    && composer install  && composer dumpautoload