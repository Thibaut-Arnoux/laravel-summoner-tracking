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

# rename assets
RUN mv ./public/build/assets/app*.js ./app.js && mv ./public/build/assets/app*.css ./app.css


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