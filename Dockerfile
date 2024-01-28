
FROM php:7.4-apache

WORKDIR /var/www/html

COPY composer.lock composer.json /var/www/html/

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-scripts --no-autoloader

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite
EXPOSE 80

