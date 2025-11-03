FROM php:7.4-apache

# PHP extensions
RUN apt-get update && apt-get install -y \
    unzip curl git zip libonig-dev libxml2-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip gd

# Apache rewrite moduli yoqiladi
RUN a2enmod rewrite

# Apache'ning DocumentRoot'ini Laravel public/ ga yo'naltiramiz
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
