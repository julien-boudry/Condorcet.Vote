FROM php:8.1-apache-bullseye

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN a2enmod rewrite
RUN a2enmod ssl
RUN service apache2 restart