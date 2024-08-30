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
    && npm run build \
    # rename assets to static name used in manifest.json from php layer
    && mv ./public/build/assets/app*.js ./app.js \
    && mv ./public/build/assets/app*.css ./app.css


# Apache
FROM httpd:2.4

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
COPY --from=frontend-builder --chown=www-data:www-data /build/app.js ./public/build/assets/app.js
COPY --from=frontend-builder --chown=www-data:www-data /build/app.css ./public/build/assets/app.css

CMD ["httpd-foreground", "-C", "PidFile /tmp/httpd.pid"]