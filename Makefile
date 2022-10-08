.PHONY: start
start:
	docker-compose up -d

.PHONY: stop
stop:
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
