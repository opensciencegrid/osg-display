FROM php:7.4.30-apache

WORKDIR /var/www/html

COPY docroot .
