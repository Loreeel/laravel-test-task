#!/bin/bash
set -e

# Встановлення залежностей, якщо відсутні
if [ ! -d "node_modules" ]; then
    npm install
fi

npm install @rollup/rollup-linux-x64-gnu --save-optional

# Запуск сервера
exec npm run dev --host