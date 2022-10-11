include .env

.PHONY: start
start:
	docker-compose up -d

.PHONY: stop
stop:
	docker-compose stop

.PHONY: down
down:
	docker-compose down

.PHONY: login-php
login-php:
	docker-compose exec app sh

.PHONY: install-composer
install-composer:
	docker-compose run composer composer install

.PHONY: require-composer
require-composer:
	docker-compose run composer composer require $d

.PHONY: dump-autoload
dump-autoload:
	docker-compose run composer composer dump-autoload

.PHONY: test
test:
	docker exec quicktrack php artisan test

.PHONY: db
db:
	docker compose exec mariadb mariadb -u ${DB_USERNAME} -p