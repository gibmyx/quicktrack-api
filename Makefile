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
	docker compose exec app php artisan test

.PHONY: migrate
migrate:
	docker compose exec app php artisan migrate

.PHONY: rollback
rollback:
	docker compose exec app php artisan migrate:rollback

.PHONY: db
db:
	docker compose exec mariadb mariadb -u ${DB_USERNAME} -p
