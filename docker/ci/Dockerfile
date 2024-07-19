# Builder for front end
FROM node:20 AS frontend-builder

WORKDIR /build

COPY /resources ./resources
COPY package.json package-lock.json postcss.config.js tailwind.config.js vite.config.js ./

RUN npm ci \
    && npm run build

# Ci Image for PHP
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

COPY --chown=www-data:www-data . ./
COPY --from=frontend-builder /build/public/build ./public/build
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

USER www-data

RUN composer install
