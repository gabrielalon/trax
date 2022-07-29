.PHONY: build
build: ## trax build and up project
		docker-compose up --build -d
		docker exec -it trax_php_1 composer install
		docker exec -it trax_php_1 npm install
		docker exec -it trax_php_1 npm run dev
		docker exec -it trax_php_1 php artisan migrate:fresh --seed

.PHONY: start
start: ## trax up project
		docker-compose up -d

.PHONY: stop
stop: ## trax up project
		docker-compose stop

.PHONY: install
install: ## initialize composer and project dependencies
		docker exec -it trax_php_1 composer install

.PHONY: update
update: ## initialize composer update
		docker exec -it trax_php_1 composer update

.PHONY: cleanup
cleanup: ## cleanup all caches
		docker exec -it trax_php_1 php artisan clear-compiled
		docker exec -it trax_php_1 php artisan event:clear
		docker exec -it trax_php_1 php artisan cache:clear
		docker exec -it trax_php_1 php artisan route:clear
		docker exec -it trax_php_1 php artisan config:clear

.PHONY: cleardb
cleardb: ## clear database and run seeders
		docker exec -it trax_php_1 php artisan migrate:fresh --seed

.PHONY: style
style: ## executes php analizers
		docker exec -it trax_php_1 ./vendor/bin/phpstan analyse -c phpstan.neon --memory-limit=256M

.PHONY: cs
cs: ## executes php cs fixer
		docker exec -it trax_php_1 ./vendor/bin/php-cs-fixer --no-interaction --diff -v fix

.PHONY: cs-check
cs-check: ## executes php cs fixer in dry run mode
		docker exec -it trax_php_1 ./vendor/bin/php-cs-fixer --no-interaction --dry-run --diff -v fix

.PHONY: test
test: ## executes phpunit tests
		docker exec -it trax_php_1 ./vendor/bin/phpunit --do-not-cache-result --colors=always -v --configuration=phpunit.xml --coverage-clover clover.xml --log-junit ./phpunit/junit.xml --testdox

.PHONY: cs-style
cs-style: cs cs-check style test ## executes php cs fixer, executes php cs fixer in dry run mode and executes php analizers

.PHONY: help
help: ## Display this help message
	@cat $(MAKEFILE_LIST) | grep -e "^[a-zA-Z_\-]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
