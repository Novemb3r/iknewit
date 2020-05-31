.PHONY: clean

clean:
	@echo Clean working directory
	git clean -fxd
	@echo Done

deps-tests:
	@echo Fetching development dependencies
	composer install --no-progress --optimize-autoloader --ignore-platform-reqs
	@echo Done

run-tests:
	@echo Runnig unit tests
	./vendor/bin/phpunit tests
	@echo Done

deps-release:
	@echo Fetch production dependencies
	composer install --no-dev --no-progress --optimize-autoloader --ignore-platform-reqs
	@echo Done

run-static-analysis:
	@echo Run static analysis code for scripts/
	vendor/bin/phpstan analyse -l 7 -c phpstan.neon scripts tests public
	@echo Done

check-codestyle:
	@echo Check codestyle
	vendor/bin/phpcs --config-set colors 1
	vendor/bin/phpcs --standard=PSR1,PSR2,PSR12 scripts tests
	@echo Done

repair-codestyle:
	@echo Check codestyle
	vendor/bin/phpcbf --config-set colors 1
	vendor/bin/phpcbf --standard=PSR1,PSR2,PSR12 scripts tests
	@echo Done

update-schema:
	@echo Updating database schme
	php vendor/bin/doctrine orm:schema-tool:update --force
	@echo Done