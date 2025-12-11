#!/bin/sh
set -e

# Check if vendor directory exists, if not install dependencies
if [ ! -d "vendor" ]; then
    echo "Vendor directory not found, installing composer dependencies..."
    composer install --no-interaction --optimize-autoloader
fi

# Ensure storage permissions
echo "Fixing storage permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Run migrations (force because we are in non-interactive mode)
echo "Running migrations..."
php artisan package:discover --ansi
php artisan migrate --force

# Start PHP-FPM
echo "Starting PHP-FPM..."
exec "$@"
