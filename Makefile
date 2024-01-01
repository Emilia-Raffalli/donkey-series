.PHONY: help

help:
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

install: ## Install all the project
	symfony composer install
	npm install
	npm run dev
	symfony console doctrine:database:create
	make rebuild

rebuild: ## Rebuild the database
	symfony console doctrine:database:drop -f
	symfony console doctrine:database:create
	symfony console doctrine:schema:update -f
	symfony console doctrine:fixtures:load -n
