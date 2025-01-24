# Базовый образ PHP с поддержкой FPM
FROM php:8.2-fpm

# Устанавливаем необходимые системные зависимости
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

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем файлы проекта
COPY . .

# # Копируем пользовательские PHP настройки
# COPY ./docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Устанавливаем зависимости через Composer
RUN composer install --no-dev --optimize-autoloader

# Настраиваем права на директории storage и bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Копируем entrypoint.sh
COPY ./docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Устанавливаем entrypoint
ENTRYPOINT ["sh", "/usr/local/bin/entrypoint.sh"]