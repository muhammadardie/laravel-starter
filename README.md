# Laravel Starter
Laravel starter kit with built in configured package for starting new project. 

![Imgur Image](https://imgur.com/0In0Hxi.png)
## Features ##
- Administration Dashboard with [Atlantis lite bootstrap](https://themekita.com/demo-atlantis-lite-bootstrap/)
- Built in access control management
- Form validation with [JS validation]( https://github.com/proengsoft/laravel-jsvalidation)
- Keep a history of model changes with [Laravel auditing](http://www.laravel-auditing.com/)
- Use uuid instead integer id [Laravel UUID](https://github.com/webpatser/laravel-uuid)
- [Yajra Datatable](https://github.com/yajra/laravel-datatables)

## Installation ##

* `git clone https://github.com/muhammadardie/laravel-starter.git`
* `cd laravel-starter`
* `composer install`
* `cp .env.example .env`
* `php artisan key:generate`
* Create a database and inform *.env*
* give permission in public/ so webserver user can write (avatar user)
* `php artisan migrate --seed` to create and populate tables
* `php artisan serve` to start the app on http://localhost:8000/

## Login

URL: https://laravel-starter-app.herokuapp.com/

Email: admin@mail.com

Password: 123456