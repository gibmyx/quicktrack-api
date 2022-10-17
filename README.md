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

