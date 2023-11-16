php-cs-check:	## Check coding-standard compliance
	docker-compose run --rm php-cli composer cs-check

php-cs-fix:	## Apply automated coding standard fixes
	docker-compose run --rm php-cli composer cs-fix
