#!/bin/bash
set -e

# Встановлення залежностей, якщо відсутні
if [ ! -d "vendor" ]; then
    composer install
fi

# Виконання миграцій
php artisan migrate --force

# Запуск серверу Laravel
exec php artisan serve --host=0.0.0.0 --port=8000