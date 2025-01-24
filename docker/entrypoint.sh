#!/bin/bash
set -e

# Установка зависимостей, если они отсутствуют
if [ ! -d "vendor" ]; then
    composer install
fi

# Выполнение миграций
php artisan migrate --force

# Запуск встроенного сервера Laravel
exec php artisan serve --host=0.0.0.0 --port=8000