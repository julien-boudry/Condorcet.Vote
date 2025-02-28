FROM dunglas/frankenphp

# ajoutez des extensions supplémentaires ici :
RUN install-php-extensions \
	pdo_mysql \
	gd \
	intl \
	zip \
	opcache

RUN cp $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
RUN if [ -n "$SERVER_NAME" ] ; then cp -f $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini ; fi

ADD opcache.ini "$PHP_INI_DIR/conf.d/opcache.ini"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copiez les fichiers PHP de votre projet dans le répertoire public
COPY . /app