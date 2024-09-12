# Laravel Starter

Laravel Starter is a robust starter kit designed to jumpstart your Laravel projects. It comes with pre-configured packages and features to streamline the development process.

![Imgur Image](https://imgur.com/0In0Hxi.png)

## Features

- **Administration Dashboard**: Powered by [Atlantis Lite Bootstrap](https://themekita.com/demo-atlantis-lite-bootstrap/), providing a sleek and responsive interface.
- **Access Control Management**: Built-in support for managing user roles and permissions.
- **Form Validation**: Integrates [JS Validation](https://github.com/proengsoft/laravel-jsvalidation) for client-side and server-side validation.
- **Model History**: Tracks changes to models with [Laravel Auditing](http://www.laravel-auditing.com/).
- **UUID Support**: Utilizes UUIDs instead of integer IDs with [Laravel UUID](https://github.com/webpatser/laravel-uuid).
- **DataTables Integration**: Includes [Yajra DataTables](https://github.com/yajra/laravel-datatables) for enhanced table functionalities.

## Requirements

- **Laravel**: >= 7.x
- **PHP**: >= 7.2.5
- **Database**: PostgreSQL

## Running the Application

### Using Laravel Serve

1. Clone the repository:
    ```bash
    git clone https://github.com/muhammadardie/laravel-starter.git
    ```
2. Navigate to the project directory:
    ```bash
    cd laravel-starter
    ```
3. Install dependencies:
    ```bash
    composer install
    ```
4. Copy the environment file:
    ```bash
    cp .env.example .env
    ```
5. Generate the application key:
    ```bash
    php artisan key:generate
    ```
6. Create a PostgreSQL database and update your `.env` file with the database details.
7. Set permissions for the `public/` directory so that the web server user can write to it:
    ```bash
    sudo chown -R www-data:www-data public/
    ```
8. Run migrations and seed the database:
    ```bash
    php artisan migrate --seed
    ```
9. Start the application:
    ```bash
    php artisan serve
    ```
   Access the app at [http://localhost:8000/](http://localhost:8000/)

### Using Docker

1. Clone the repository:
    ```bash
    git clone https://github.com/muhammadardie/laravel-starter.git
    ```
2. Navigate to the project directory:
    ```bash
    cd laravel-starter
    ```
3. Copy the environment file:
    ```bash
    cp .env.example .env
    ```
4. Update `.env` with your database details. Use `DB_HOST=host.docker.internal` to connect to a PostgreSQL instance on your host machine.
5. Build and start the Docker containers:
    ```bash
    docker compose up -d --build
    ```
6. Access the Docker container:
    ```bash
    docker compose exec app bash
    ```
7. Set appropriate permissions for Laravel’s storage and cache directories:
    ```bash
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache
    ```
8. Install PHP dependencies:
    ```bash
    composer install
    ```
9. Generate the application key:
    ```bash
    php artisan key:generate
    ```
10. Run migrations and seed the database:
    ```bash
    php artisan migrate --seed
    ```

## Demo

- **URL**: [https://laravel-starter.muhammadardie.tech/](https://laravel-starter.muhammadardie.tech/)
- **Email**: admin@mail.com
- **Password**: 123456