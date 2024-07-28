FROM phpdockerio/php74-fpm

MAINTAINER fire7617  version: 0.1

RUN apt-get update -y
RUN apt-get install vim git php8.3-mysql iputils-ping redis-server php-redis -y
RUN apt-get install php8.3-mcrypt php8.3-gd -y
RUN apt-get install net-tools curl iputils-ping -y
RUN apt-get install php-xdebug -y
#RUN apt-get install php8.3-dev
#kiwi package
RUN apt-get install php-mongodb php8.3-mongodb -y
#RUN apt-get install php-dev
#RUN apt-get install php-xdebug php8.3-zip  php8.3-imagick -y
RUN apt-get install php8.3-bcmath php8.3-xml
#install composer
#RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
#RUN php composer-setup.php
#RUN php -r "unlink('composer-setup.php');"
#RUN composer require --dev phpunit/phpunit ^7


#RUN apt-get install php-xdebug
#RUN echo "xdebug.mode=debug" >> /etc/php/8.3/mods-available/xdebug.ini
#RUN echo "xdebug.start_with_request=yes" >> /etc/php/8.3/mods-available/xdebug.ini
#RUN echo "xdebug.discover_client_host=0"  >> /etc/php/8.3/mods-available/xdebug.ini
#RUN echo "xdebug.client_port = 9003" >> /etc/php/8.3/mods-available/xdebug.ini
#RUN echo "xdebug.client_host=host.docker.internal" >> /etc/php/8.3/mods-available/xdebug.ini

WORKDIR /app
ENTRYPOINT php artisan serve --host 0.0.0.0
