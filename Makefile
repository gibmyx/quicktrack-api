.PHONY: start
start:
	docker-compose up -d

.PHONY: stop
stop:
	docker-compose down

.PHONY: login-php
login-php:
	docker-compose exec app sh
