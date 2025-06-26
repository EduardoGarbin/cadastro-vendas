FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl

RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache \
    && find /var/www -type f -exec chmod 664 {} \; \
    && find /var/www -type d -exec chmod 775 {} \;

EXPOSE 9000

CMD ["php-fpm"]
