## Description

This is a project developed to read specifics xmls file and save the data on database.

## Pre-requisites

Docker version 20.10.2

## Installation

After clone the project, you can run 
```
docker-compose up -d
```

```
docker-compose exec php-fpm composer install
```

```
docker-compose exec php-fpm php artisan migrate
```

```
Access to http://localhost:8002
```
The frontend project is in another project. See in <a href="https://github.com/fabinhoc/xml-reader-frontend">XML-reader-frontend</a>

## Run tests

```
docker-compose exec php-fpm php artisan test
```

## GO to frontend project

<a href="https://github.com/fabinhoc/xml-reader-frontend">XML-reader-frontend</a>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
