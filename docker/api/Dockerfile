FROM php:7.3-fpm-alpine3.10

ARG MY_APP
ARG APP_ROOT

#
# base 
#
RUN apk --no-cache update && \
    apk --no-cache upgrade \
    && apk add --no-cache --virtual .gd-deps \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libwebp-dev \
    && apk add --no-cache --virtual .zip-deps \
        libzip-dev \
    && apk add --no-cache --virtual .envsubst-deps \
        libintl \
    && apk --no-cache add --virtual .gettext \
        gettext \
    && pecl update-channels \
    && docker-php-ext-install \
        pdo_mysql \
        opcache \
    && docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
        --with-png-dir=/usr/include/ \
        --with-webp-dir=/usrinclude/ \
    && docker-php-ext-configure zip \
        --with-libzip \
    && docker-php-ext-install \
        gd \
        zip \
    && rm -rf /tmp/pear ~/.pearrc \
    && apk del .gettext

#
# extra ini files
#
COPY ./docker/api/usr/local/etc/php/conf.d/mbstring.ini /usr/local/etc/php/conf.d/mbstring.ini
COPY ./docker/api/usr/local/etc/php/conf.d/memory_limit.ini /usr/local/etc/php/conf.d/memory_limit.ini

#
# composer
#
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
  && chmod +x /usr/local/bin/composer \
  && composer global require hirak/prestissimo

#
# Create app root directory
#

# RUN mkdir -p /var/www/app
# COPY ./ /var/www/app
# WORKDIR /var/www/app
RUN mkdir ${APP_ROOT}
WORKDIR ${APP_ROOT}
ADD ${MY_APP} ${APP_ROOT}

#
# Permissions
#
RUN chgrp -R www-data \
    ${APP_ROOT}/storage \
    ${APP_ROOT}/bootstrap/cache \
  && chmod -R ug+rwx \
      ${APP_ROOT}/storage \
      ${APP_ROOT}/bootstrap/cache