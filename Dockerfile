FROM php:7.4.11-apache

WORKDIR /var/www/html

COPY docroot .
