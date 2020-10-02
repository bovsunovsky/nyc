FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git

RUN docker-php-ext-install pdo pdo_mysql \
 && pecl install xdebug \
 && docker-php-ext-enable xdebug

COPY ./xdebug.ini $PHP_INI_DIR/conf.d/

RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer