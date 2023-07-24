FROM php:8.2-fpm

# Installing dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    default-mysql-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libmagickwand-dev \
    libzip-dev \
    libonig-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installing extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath opcache gd
RUN apt-get update
RUN apt-get install vim -y
RUN echo 'alias cls="clear"' >> ~/.bashrc
RUN echo 'alias ll="ls -alh"' >> ~/.bashrc

COPY ./docker/phpfpm/local.ini /usr/local/etc/php/conf.d/local.ini

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Setting locales
RUN echo fr_FR.UTF-8 UTF-8 > /etc/locale.gen && locale-gen

# Changing Workdir
COPY . /var/www/html
WORKDIR /var/www/html
RUN chown -R root:www-data /var/www/html

# Install
RUN composer install
RUN cp .env.example .env
RUN php artisan key:generate
RUN chmod -R a+w storage/ bootstrap/cache

EXPOSE 9000
