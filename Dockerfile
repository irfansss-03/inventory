# Dockerfile

# Stage 1: Build with PHP 8.2 and Composer
FROM php:8.4-fpm-alpine as vendor

# Install system dependencies, PHP extensions, and git
RUN apk add --no-cache \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    && docker-php-ext-install gd zip

# Copy composer binary from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set up workdir and run install
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --optimize-autoloader --no-scripts

# Stage 2: Build frontend assets
FROM node:20 as frontend

WORKDIR /app
COPY . .
RUN npm install && npm run build

# Stage 3: Final application image
FROM php:8.4-fpm-alpine

WORKDIR /var/www

# Install system dependencies and PHP extensions
# Removed nginx and supervisor as they are not needed in the app container (we have a separate web service)
RUN apk add --no-cache \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    mysql-client

RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Copy application code and built assets
# Note: These might be overlaid by docker-compose volumes during dev, 
# but are essential for production builds.
COPY --from=vendor /app/vendor /var/www/vendor
COPY --from=frontend /app/public /var/www/public
COPY . /var/www

# Copy entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set correct permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]