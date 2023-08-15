FROM php:8.1-fpm

WORKDIR /var/www/auctions-api

RUN docker-php-ext-install pdo_mysql 

RUN docker-php-ext-install opcache

RUN pecl install apcu && docker-php-ext-enable apcu

COPY php.ini /usr/local/etc/php/conf.d/custom.ini
