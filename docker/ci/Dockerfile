# Front Static Assets
FROM node:20 AS frontend-builder

WORKDIR /build

COPY /resources ./resources
COPY package.json package-lock.json postcss.config.js tailwind.config.js vite.config.js ./

RUN npm ci \
    && npm run build

# Php Ci Layer
FROM php:8.3-fpm

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y zip unzip libpq-dev \
    # php extensions
    && docker-php-ext-install pdo pdo_pgsql sockets \
    # xdebug in coverage mode required for pest coverage cli
    && pecl install xdebug && docker-php-ext-enable xdebug \
    # clean
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY . .
COPY --from=frontend-builder /build/public/build ./public/build
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY docker/ci/php.ini /usr/local/etc/php/conf.d/docker-php-ext-ci.ini

RUN composer install
