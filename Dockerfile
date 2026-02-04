FROM php:8.3-fpm

WORKDIR /var/www/html

# Install dependencies + NodeJS + NPM
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project
COPY . .

# Install PHP packages
RUN composer install --no-dev --optimize-autoloader

# Install Node packages and build assets
RUN npm install
RUN npm run build

# Expose port
EXPOSE 10000

# Run pending migrations (without creating new ones) and start server
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000

