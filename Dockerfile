FROM php:apache

WORKDIR /var/www/html

RUN service apache2 restart

EXPOSE 80
