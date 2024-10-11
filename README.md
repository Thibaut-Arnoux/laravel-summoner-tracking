# Setup

## Local

### Requirements

-   php8.2 and/or sail installed globally
-   docker
-   docker compose

### Installation

1. Install php dependencies: `composer install`
2. Start containers: `./vendor/bin/sail up --build -d`
3. Migrate schema: `./vendor/bin/sail artisan migrate`
4. Install node dependencies: `./vendor/bin/sail npm install`

### Start

1. Start containers: `./vendor/bin/sail up --build -d`
2. Start node: `./vendor/bin/sail npm run dev`

## Production

1. Add env file for production: `cp .env.production.example .env.production`
2. Fill env variables :
    - APP_KEY
    - DB_HOST
    - DB_PORT
    - DB_DATABASE
    - DB_USERNAME
    - DB_PASSWORD
3. Start containers: `docker compose -f compose.production.yaml --env-file .env.production up --build`
4. Connect to php-fpm container: `php artisan migrate`

## Dockerhub

CI : https://hub.docker.com/repository/docker/thibautarnoux/laravel-summoner-tracking-ci/general  
Apache : https://hub.docker.com/repository/docker/thibautarnoux/laravel-summoner-tracking-apache  
App : https://hub.docker.com/repository/docker/thibautarnoux/laravel-summoner-tracking/general
