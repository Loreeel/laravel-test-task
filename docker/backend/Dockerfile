FROM php:8.2-fpm

# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем Laravel
WORKDIR /var/www
COPY ./backend /var/www


RUN composer install --no-dev --optimize-autoloader

# Разрешаем запись в storage
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Копіюємо entrypoint.sh
COPY docker/backend/scripts/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["sh", "/usr/local/bin/entrypoint.sh"]
#CMD ["php-fpm"]