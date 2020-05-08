FROM php:7.1.33-fpm

COPY ./docker/php_receiver/bcmath.ini /etc/php/7.1/cli/conf.d/20-bcmath.ini
USER 1000:1000

WORKDIR /var/www/html