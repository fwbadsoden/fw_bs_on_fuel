FROM php:7.2-apache

RUN set -eux; \
    if [ -f /etc/apt/sources.list ]; then \
        sed -i 's|deb.debian.org/debian|archive.debian.org/debian|g; s|security.debian.org/debian-security|archive.debian.org/debian-security|g' /etc/apt/sources.list; \
        sed -i '/stretch-updates/d; /buster-updates/d' /etc/apt/sources.list || true; \
    fi; \
    printf 'Acquire::Check-Valid-Until "false";\nAcquire::AllowInsecureRepositories "true";\n' > /etc/apt/apt.conf.d/99archive; \
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
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/; \
    docker-php-ext-install -j"$(nproc)" gd intl mbstring mysqli pdo_mysql zip; \
    a2enmod expires headers rewrite; \
    rm -rf /var/lib/apt/lists/*

COPY docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php/php-local.ini /usr/local/etc/php/conf.d/zz-local.ini