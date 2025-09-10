include .env
# Variables
current_dir := $(shell pwd)
uid := $(shell id -u)
gid := $(shell id -g)

up:
	docker-compose -f docker-compose.yml up -d

down:
	docker-compose -f docker-compose.yml down

in:
	docker exec -it --user ${APP_USER} ${PROJECT_NAME}_app bash

