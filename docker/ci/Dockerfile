# Composer UI Layer
FROM composer:2.7 AS ui-builder

WORKDIR /build

COPY composer.json composer.lock ./

RUN composer install --optimize-autoloader --no-dev --no-scripts

# Front Static Assets
FROM node:20 AS frontend-builder

WORKDIR /build

COPY package.json package-lock.json postcss.config.js tailwind.config.js vite.config.js ./
# required from tailwind config
COPY /resources ./resources
COPY /app/Livewire ./app/Livewire
COPY /app/View/Components ./app/View/Components
COPY --from=ui-builder /build/vendor/robsontenorio/mary/src/View/Components ./vendor/robsontenorio/mary/src/View/Components

RUN npm ci \
    && npm run build

# Php Ci Layer
FROM php:8.3-cli

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
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
COPY docker/ci/php.ini /usr/local/etc/php/conf.d/docker-php-ext-ci.ini

RUN composer install
