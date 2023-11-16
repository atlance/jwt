composer-install:	## Install composer dependecies.
	docker-compose run --rm php-cli composer install --prefer-dist --no-interaction --no-progress