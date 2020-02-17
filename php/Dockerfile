FROM php:7.4-fpm
RUN apt-get update && apt-get install -y \
        curl procps\
    && docker-php-ext-install pdo pdo_mysql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY xdebug.ini /usr/local/etc/php/conf.d/
COPY php.ini /usr/local/etc/php/php.ini

