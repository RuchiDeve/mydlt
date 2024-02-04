
FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    libonig-dev \
    libpng-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    cron

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# create destination directory
RUN mkdir /var/www/app

# Set working directory
WORKDIR /var/www/app


RUN cd /var/www/app && git clone https://dennisohere:UVDXZcyzBpabuAYPmtB7@bitbucket.org/dennisohere/mydlt.git .

RUN git pull origin master

RUN cp /var/www/app/.env.prod /var/www/app/.env

RUN composer install

RUN chown -R www-data:www-data .

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

