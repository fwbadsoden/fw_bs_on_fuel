FROM php:8.4-apache

RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        default-mysql-client \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev \
        libzip-dev \
        unzip \
        zip; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j"$(nproc)" gd intl mbstring mysqli pdo_mysql zip; \
    a2enmod expires headers rewrite; \
    rm -rf /var/lib/apt/lists/*

COPY docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php/php-local.ini /usr/local/etc/php/conf.d/zz-local.ini