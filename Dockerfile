# Dockerfile

FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev \
    && docker-php-ext-install pdo_mysql zip

WORKDIR /var/www
