FROM php:8.3-cli

ARG NODE_VERSION=20

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y gnupg zip unzip libpq-dev \
    # php extensions
    && docker-php-ext-install pdo pdo_pgsql sockets \
    # xdebug in coverage mode required for pest coverage cli
    && pecl install xdebug && docker-php-ext-enable xdebug \
    # nodejs
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_VERSION.x nodistro main" > /etc/apt/sources.list.d/nodesource.list \
    && apt-get update \
    && apt-get install -y nodejs \
    # clean
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY . .
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
COPY docker/ci/php.ini /usr/local/etc/php/conf.d/docker-php-ext-ci.ini

RUN composer install \
    && npm ci \
    && npm run build
