FROM php:8.1-apache

RUN apt-get update && \
    apt-get install

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html