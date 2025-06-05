# Gunakan PHP dengan FPM
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files (kecuali yang ada di .dockerignore)
COPY . .

# Install dependencies with Composer
RUN composer install --no-dev --optimize-autoloader \
    && php artisan cache:clear \
    && php artisan config:clear \
    && php artisan view:clear \
    && php artisan route:clear

# Copy project files (kecuali yang ada di .dockerignore)
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/database \
    && chmod -R 777 /var/www/database

# Jalankan migration saat build (karena pakai SQLite)
RUN php artisan migrate --force || true

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
