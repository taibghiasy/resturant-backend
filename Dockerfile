FROM php:8.3-fpm

WORKDIR /var/www/html

# Install dependencies + NodeJS
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev curl zip \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install
ENV NODE_ENV=production
RUN npm run build

# Clear caches
RUN php artisan config:clear
RUN php artisan route:clear
RUN php artisan view:clear
RUN php artisan cache:clear

# Expose port
EXPOSE 10000

# Start PHP-FPM
CMD ["php-fpm"]

