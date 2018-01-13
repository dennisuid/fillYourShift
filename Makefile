all: clear-cache clean deps phpcs

clear-cache:
	php bin/console cache:clear --env=dev
	php bin/console cache:clear --env=prod
	php bin/console cache:clear --env=test
server-run:
	php bin/console server:run

composer.phar:
	curl -sS https://getcomposer.org/installer | php

deps: composer.phar
	php composer.phar install --no-interaction

clean:
	rm -rf vendor
	rm -f web/css/style.css
	rm -rf var/cache/*
	rm -rf var/logs/*
	rm var/bootstrap.php.cache

database-clean:
	php bin/console doctrine:database:drop --force
phpcs:
	vendor/bin/phpcs --standard=phpcd_ruleset.xml  src/Shift/

phpcs-fixed:

	vendor/bin/phpcbf src/Shift/
phpmd:
	vendor/bin/phpmd  src/Shift/ text codesize phpmd_ruleset.xml

phpunit:
	vendor/bin/phpunit

