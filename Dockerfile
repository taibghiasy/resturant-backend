FROM php:8.3-fpm

WORKDIR /var/www/html

# System deps + Node
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev curl zip \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project
COPY . .

# PHP deps
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Frontend build
RUN npm install
ENV NODE_ENV=production
RUN npm run build

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Copy entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 10000

ENTRYPOINT ["entrypoint.sh"]

# Use PHP built-in server (RENDER FRIENDLY)
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
