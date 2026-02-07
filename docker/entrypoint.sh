#!/bin/sh
set -e

echo "Running Laravel startup tasks..."

# Give services a moment to be ready
sleep 5

# Generate APP_KEY if not exists (force)
php artisan key:generate --force || true

# Run migrations (force)
php artisan migrate --force || true

# Clear caches and optimize
php artisan optimize:clear || true

# Create storage symbolic link (force overwrite if exists)
php artisan storage:link --force || true

echo "Laravel startup tasks completed. Starting server..."

# Run the main container command (PHP built-in server)
exec "$@"
