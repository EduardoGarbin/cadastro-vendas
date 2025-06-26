# Variáveis
ARTISAN=docker exec -it laravel-app php artisan
COMPOSER=docker exec -it laravel-app composer
NPM=docker exec -it vue-app npm


# Laravel
artisan:
	docker exec -it laravel-app php artisan $(filter-out $@,$(MAKECMDGOALS))
	
migrate:
	$(ARTISAN) migrate

seed:
	$(ARTISAN) db:seed

migrate-refresh:
	$(ARTISAN) migrate:fresh --seed

tinker:
	$(ARTISAN) tinker

routes:
	$(ARTISAN) route:list

# Composer
composer-install:
	$(COMPOSER) install

# Frontend
npm-install:
	$(NPM) install

npm-dev:
	$(NPM) run dev -- --host

# Docker
up:
	docker-compose up -d

build:
	docker-compose build

down:
	docker-compose down

restart:
	docker-compose down && docker-compose up -d --build
