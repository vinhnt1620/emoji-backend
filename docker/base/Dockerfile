FROM php:8.2-apache as base

RUN apt-get update
RUN apt-get install libicu-dev -y
RUN apt-get install default-mysql-client -y
RUN docker-php-ext-configure intl

RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install intl
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install opcache
RUN docker-php-ext-install exif
RUN docker-php-ext-install bcmath

RUN apt-get install libzip-dev -y
RUN docker-php-ext-install zip

RUN apt-get install libpng-dev -y
RUN docker-php-ext-install gd

RUN apt-get install libonig-dev -y
RUN docker-php-ext-install mbstring

RUN apt-get install libcurl4-openssl-dev -y
RUN apt-get install libcurl4 -y
RUN docker-php-ext-install curl
#RUN pecl install redis && docker-php-ext-enable redis

RUN apt-get update
RUN apt-get install cron -y
RUN apt-get install vim -y

RUN php -v
RUN php -m
