# Front Static Assets
FROM node:20 AS frontend-builder

WORKDIR /build

COPY /app/Livewire ./app/Livewire
COPY /app/View/Components ./app/View/Components
COPY /resources ./resources
COPY package.json package-lock.json postcss.config.js tailwind.config.js vite.config.js ./

# TODO : add mary ui required in tailwind config

RUN npm ci \
    && npm run build


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
COPY --from=frontend-builder --chown=www-data:www-data /build/public/build/manifest.json ./public/build/manifest.json
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY docker/production/php/php.ini /usr/local/etc/php/conf.d/docker-php-ext-production.ini

USER www-data

RUN composer install --optimize-autoloader --no-dev