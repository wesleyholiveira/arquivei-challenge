FROM php:7.3-fpm

VOLUME /app
WORKDIR /app

RUN docker-php-ext-install -j$(nproc) mbstring mysqli pdo pdo_mysql
CMD ["php-fpm"]