FROM php:8.2-apache-bullseye

RUN apt-get update
RUN apt-get install --no-install-recommends --fix-missing -yqq git unzip curl libzip-dev
RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install zip


RUN a2enmod rewrite
RUN a2enmod ssl
RUN service apache2 restart

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1