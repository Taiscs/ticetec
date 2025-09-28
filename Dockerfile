# Usa imagem PHP com FPM
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Se o composer.json estiver em uma pasta chamada "laravel"
COPY laravel/composer.json laravel/composer.lock ./

RUN composer install --no-dev --optimize-autoloader

# Copia todo o código do projeto
COPY laravel/ ./

RUN mkdir -p /var/www/storage/framework/{sessions,views,cache} \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 8000

CMD sh -c "php artisan serve --host=0.0.0.0 --port=$PORT"




