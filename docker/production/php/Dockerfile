# Php
FROM php:8.3-fpm

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y zip unzip libpq-dev \
    # php extensions
    && docker-php-ext-install pdo pdo_pgsql sockets \
    # clean
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --chown=www-data:www-data . .
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
COPY docker/production/php/php.ini /usr/local/etc/php/conf.d/docker-php-ext-production.ini
COPY docker/production/php/manifest.json /var/www/html/public/build/manifest.json

USER www-data

RUN composer install --optimize-autoloader --no-dev