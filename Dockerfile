FROM php:8.3-fpm

WORKDIR /var/www

# dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip gd

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# copy project
COPY . .

RUN composer install --no-dev --optimize-autoloader

# permission
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]