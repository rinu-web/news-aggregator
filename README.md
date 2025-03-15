1)Prerequisites

Docker Desktop
Git
Composer
PHP

2)git clone https://github.com/rinu-web/news-aggregator.git
cd news-aggregator

3)Update database settings in .env

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=user
DB_PASSWORD=password

Include the api keys to access the data in .env file

NEWSAPI_KEY=9aaaf725fe81464d9797c525d88e9496

GUARDIAN_KEY=069b26b8-25dd-4d37-8ac4-8f54bc4cebb3

NYTIMES_KEY=9aaaf725fe81464d9797c525d88e9496

4)Start the Docker Environment

Run the following command to build and start the Laravel app and MySQL database in Docker:

docker-compose up -d --build

This will:

Start the Laravel app in a container (laravel_app).
Start a MySQL 8 database container (laravel_db).

5)Access the Application

Laravel API: http://localhost:8000
Swagger Docs: http://localhost:8000/api/documentation

6)The Laravel application runs inside a Docker container using php artisan serve.
MySQL database is configured in a separate container and persists data using a Docker volume.
API authentication is implemented using Laravel Sanctum.
Articles are fetched and stored from external news sources.
