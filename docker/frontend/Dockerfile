FROM node:18

# Устанавливаем рабочую директорию
WORKDIR /app

# Копируем package.json и package-lock.json (если существует)
COPY ./frontend/package*.json ./

# Устанавливаем зависимости
RUN npm install
# Копируем остальные файлы фронтенда
COPY ./frontend /app

# Копіюємо entrypoint.sh
COPY docker/frontend/scripts/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["sh", "/usr/local/bin/entrypoint.sh"]