FROM php:8.2-cli

# Install system dependencies and PHP extensions
RUN apt-get update && \
    apt-get install -y git unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl gnupg && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip && \
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@latest && \
    rm -rf /var/lib/apt/lists/*

# Install Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Default command runs Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
