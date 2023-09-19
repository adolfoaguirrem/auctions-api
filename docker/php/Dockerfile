FROM php:8.1-fpm

RUN apt-get -y update \
    && apt-get install -y libssl-dev pkg-config libzip-dev unzip git

RUN pecl install zlib zip xdebug \
&& docker-php-ext-enable zip \
&& docker-php-ext-enable xdebug

# Install composer (updated via entry point)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_mysql 

RUN docker-php-ext-install opcache

RUN pecl install apcu && docker-php-ext-enable apcu

WORKDIR /var/www/auctions-api

COPY php.ini /usr/local/etc/php/conf.d/custom.ini
