# UID/GID
UID := $(shell id -u)
GID := $(shell id -g)
export UID
export GID

# Variáveis
COMPOSER=docker exec -it laravel-app composer
NPM=docker exec -it vue-app npm

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
	docker-compose build --no-cache

down:
	docker-compose down

restart:
	docker-compose down && docker-compose up -d --build
