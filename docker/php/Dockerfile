FROM php:5.4-fpm

# VARIABLES
ENV TIMEZONE=Europe/Paris

# First install

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip \
    zip \
    locales \
    mysql-client \
    apt-transport-https \
    gnupg

# PHP Ext
RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev libfontconfig1-dev libjpeg62-turbo-dev libpng-dev libfreetype6-dev g++ curl libcurl3 \
    && docker-php-ext-install pdo_mysql intl mysqli gd \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/

RUN docker-php-ext-install exif
RUN docker-php-ext-configure exif --enable-exif

# Set php.ini
COPY app.ini /usr/local/etc/php/conf.d/

# Set timezone
RUN ln -snf /usr/share/zoneinfo/$TIMEZONE /etc/localtime && echo $TIMEZONE > /etc/timezone

# Get composer
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer && \
    chmod +x /usr/local/bin/composer
RUN composer --version

# install xdebug
RUN pecl channel-update pecl.php.net
RUN pecl install xdebug-2.4.1
RUN docker-php-ext-enable xdebug

CMD ["php-fpm"]

WORKDIR /var/www/html
