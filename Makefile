all: clear-cache clean deps

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
