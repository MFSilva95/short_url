# About The Project

API for creation and redirection of short URL

## How to Run

-   Composer update/install `composer install`

-   Install NPM dependencies `npm install`

-   Run `php artisan serve`

## Setup BD:

### In docker:

-   Run: `docker-compose up -d`
-   Run migrations in shell: `php artisan migrate`

### Can also create the db with XAMPP or other method you like

## Endpoints

| Endpoint        | method | Description      |
| --------------- | ------ | ---------------- |
| /api/links      | POST   | Create short url |
| /api/{shortUrl} | GET    | Redirect         |
