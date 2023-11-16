docker-build:	## Buid dev images
	docker-compose build

docker-up:	## Start service.
	docker-compose up -d

docker-down:	## Stop service.
	docker-compose down

docker-down-clear:	## Stop service and remove volumes.
	docker-compose down --remove-orphans -v

docker-compose:	## Make docker-compose.yml
	envsubst < config/docker-compose.dist > docker-compose.yml
