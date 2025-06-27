# UID/GID
UID := $(shell id -u)
GID := $(shell id -g)
export UID
export GID

# Variáveis
COMPOSER=docker exec -it laravel-app composer
NPM=docker exec -it vue-app npm
ARTISAN=docker exec -it laravel-app php artisan

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
	docker compose up -d

build:
	docker compose build --no-cache

down:
	docker compose down

restart:
	docker compose down && docker compose up -d --build

restart-frontend:
	docker compose down frontend && docker compose up -d --build frontend
	
db-seed:
	$(ARTISAN) db-seed

migration-up-all:
	$(ARTISAN) migrate
