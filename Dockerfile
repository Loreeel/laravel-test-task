# Базовий образ PHP
FROM php:8.2-fpm

# Встановлення залежностей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Встановлення Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Встановлення робочої директорії
WORKDIR /var/www/html

# Копіюємо файли проекта
COPY . .

# Встановлення залежностей через Composer
RUN composer install --no-dev --optimize-autoloader

# Налаштування прав на директорії storage и bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Копіюємо entrypoint.sh
COPY ./docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Встановлюємо entrypoint
ENTRYPOINT ["sh", "/usr/local/bin/entrypoint.sh"]
