FROM php:8.2.7-fpm-buster

# Laravel が依存している拡張機能
RUN apt update \
    && apt install -y libzip-dev \
    && docker-php-ext-install zip

# MySQL へ DB 保存する拡張機能
RUN docker-php-ext-install pdo_mysql

# デバッグ実行用拡張機能
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/html

COPY composer.phar composer.phar
COPY composer.json composer.json
COPY composer.lock composer.lock

COPY artisan artisan
COPY bootstrap bootstrap
COPY app app
COPY config config
COPY routes routes

RUN php composer.phar install

COPY ./docker/local/php-fpm/php.ini /usr/local/etc/php/php.ini
COPY . /var/www/html

RUN chmod -R ugo+w logs
RUN chmod -R ugo+rw storage
