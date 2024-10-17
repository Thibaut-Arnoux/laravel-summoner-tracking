################
# Builder target
################

# Composer UI Layer
FROM composer:2.7 AS ui-builder

WORKDIR /build

COPY composer.json composer.lock ./

RUN composer install --optimize-autoloader --no-dev --no-scripts

# Front Static Assets
FROM node:20 AS assets-builder

WORKDIR /build

COPY package.json package-lock.json postcss.config.js tailwind.config.js vite.config.js ./
# required from tailwind config
COPY /resources ./resources
COPY /app/Livewire ./app/Livewire
COPY /app/View/Components ./app/View/Components
COPY --from=ui-builder /build/vendor/robsontenorio/mary/src/View/Components ./vendor/robsontenorio/mary/src/View/Components

RUN npm ci \
    && npm run build



###############
# Apache target
###############
FROM httpd:2.4 AS apache2

WORKDIR /var/www/html

COPY docker/production/apache2/apache.vhost.conf /usr/local/apache2/conf/extra/apache.vhost.conf

RUN sed -i \
    -e '/#LoadModule proxy_module/s/^#//g' \
    -e '/#LoadModule proxy_fcgi_module/s/^#//g' \
    -e '/#LoadModule rewrite_module/s/^#//g' \
    /usr/local/apache2/conf/httpd.conf \
    && echo "Include /usr/local/apache2/conf/extra/apache.vhost.conf" >> /usr/local/apache2/conf/httpd.conf

USER www-data

COPY --chown=www-data:www-data /public ./public
COPY --from=assets-builder --chown=www-data:www-data /build/public/build/assets/ ./public/build/assets/

CMD ["httpd-foreground", "-C", "PidFile /tmp/httpd.pid"]



############
# Php target
############
FROM php:8.3-fpm AS php

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
COPY --from=assets-builder --chown=www-data:www-data /build/public/build/manifest.json /var/www/html/public/build/manifest.json

USER www-data

RUN composer install --optimize-autoloader --no-dev