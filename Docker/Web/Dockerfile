FROM php:8.4-apache-bookworm

RUN apt-get update
RUN apt-get install --no-install-recommends --fix-missing -yqq git unzip curl libzip-dev
RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql && docker-php-ext-install zip
RUN docker-php-ext-install opcache
ADD opcache.ini "$PHP_INI_DIR/conf.d/opcache.ini"


RUN a2enmod rewrite
RUN a2enmod ssl
RUN service apache2 restart

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer update