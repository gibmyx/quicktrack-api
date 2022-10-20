# Development installation process 

## Copy environment files 
    - Copy archivo .env.example
    - Copy archivo phpunit.xml.example

## Add values to environment variables
    - JWT_SECRET
    - JWT_ALGO
    - FORWARD_DB_PORT

### Add values to DB in .env
    - DB_PASSWORD
    - DB_ROOT_PASSWORD

## Run command Makefile
    - make start
    - make migrate
    - make test

## Run url in nav
    - http://localhost:8000/

## Create user tinker for tests
    - make login-php

    - php artisan tinker
    - $user = new \Quicktrack\User\Infrastructure\Eloquent\Models\User;
    - $user->name = "xxx";
    - $user->email = "example@example.com";
    - $user->password = Hash::make("12345");
    - $user->save();

