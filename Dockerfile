# Dockerfile

FROM php:8.3-cli

ARG UID=1000
ARG GID=1000

RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# samakan UID/GID dengan host
RUN groupadd -g ${GID} laravel \
 && useradd -u ${UID} -g laravel -m laravel

WORKDIR /var/www

# pakai user non-root
USER laravel
