$(shell cp -n config/.env.dist .env)

include ./.env
export $(shell sed 's/=.*//' ./.env)

-include ./make/*.mk

.PHONY: help

help:	## Display this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\.]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help
