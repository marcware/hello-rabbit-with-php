FROM php:7.1.33-fpm

## RUN apt-get update && apt-get install -y  php7.1-bcmath
#\
#	&& docker-php-ext-install curl \
#	&& apt-get clean \
#    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

#RUN apk update && apk add -f libcurl \
#	&& docker-php-ext-install curl bcmath

# RUN docker-php-ext-install bcmath

COPY ./docker/php_receiver/bcmath.ini /etc/php/7.1/cli/conf.d/20-bcmath.ini
USER 1000:1000

WORKDIR /var/www/html