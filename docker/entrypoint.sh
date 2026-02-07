#!/bin/sh
set -e

echo "Running Laravel startup tasks..."

sleep 5

php artisan key:generate --force || true
php artisan migrate --force || true
php artisan optimize:clear || true

echo "Starting server..."
exec "$@"
