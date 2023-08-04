FROM php:8.2-apache as base

RUN apt-get update
RUN apt-get install libicu-dev default-mysql-client libzip-dev libpng-dev libonig-dev libcurl4-openssl-dev libcurl4 cron vim -y
RUN docker-php-ext-configure intl && \
    docker-php-ext-install pdo pdo_mysql intl pcntl opcache exif bcmath zip gd mbstring curl

RUN php -v
RUN php -m