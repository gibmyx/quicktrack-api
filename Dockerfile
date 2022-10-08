FROM php:8.1-apache

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && \
    apt-get install

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user && \
    chmod -R 755 /var/www/html/storage /var/www/html/storage/*

# Set the user
USER $user
