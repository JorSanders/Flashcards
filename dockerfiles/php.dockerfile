ARG PHPVERSION=0
FROM php:${PHPVERSION}-fpm-alpine

# I think this is needed in the start, for installing some php extensions
RUN docker-php-source extract

RUN apk update

# Install busybox remove the www-data user.
# Replace it with one with the same id as the user
# Chown on /var/www/
RUN apk add --no-cache -u busybox
RUN deluser www-data
RUN set -x \
	&& addgroup -g 1000 -S www-data \
	&& adduser -u 1000 -D -S -G www-data www-data
RUN chown -R www-data /var/www/

# Laravel requirements
RUN docker-php-ext-install pdo
RUN docker-php-ext-install mbstring
RUN apk add --no-cache libmcrypt-dev
RUN apk add --no-cache mysql-client
RUN docker-php-ext-install pdo_mysql
RUN apk add --no-cache git

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clean up
RUN docker-php-source delete
RUN rm -rf /var/cache/apk/*

# Change the user that executes commands
USER www-data

