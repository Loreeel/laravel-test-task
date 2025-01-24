# Запуск проекту

Для запуску проекту виконайте наступні кроки:

## 1. Створення файлу `.env`

Скопіюйте файл `.env.example` и перейменуйте його в `.env`. Потім відкрийте файл `.env` та замініть наступні строки:

```env
DB_CONNECTION=mariadb
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=root
```

## 2. Запуск контейнерів Docker

Після налаштувань файла `.env`, виконайте команду для запуску контейнерів Docker:

```bash
docker-compose up --build
```

## 3. Доступ к приложению

Після успішного запуску контейнерів, додаток буде доступний за наступною адресою:

http://localhost:8000

## 4. API

# Авторизація та аутентифікація
 POST api/v1/register Реєстрація користувача
 Необхідні поля:
    {
    	"name":"Name",
    	"email":"mail@email.com",
    	"password":"password"
    }
    
 POST api/v1//login   Авторизація користувача
  Необхідні поля:
    {
    	"email":"mail@email.com",
    	"password":"password"
    }
    
 GET  api/v1/logout   Видалення авторизаційного токену з БД
