FROM php:8.2-fpm

# Установим системные зависимости
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    # Установим Node.js и npm
    && curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка рабочей директории
WORKDIR /var/www

# Копируем файлы проекта в контейнер
COPY . .

# Устанавливаем зависимости через Composer
RUN composer install

# Открываем порт для сервера
EXPOSE 8000

# Команда для запуска сервера
CMD php artisan serve --host=0.0.0.0 --port=8000