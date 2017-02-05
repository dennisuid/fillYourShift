# fillYourShift
project for temporary staff shift fulfilment

Install Composer for Windows
-----------------------------
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

php composer.phar -install-dir=bin

Install API Platform 
-----------------
php composer.phar require api-platform/core

Git Commands
--------------
git checkout testGit
git branch
git status
git add .
git commit
git push --set-upstream origin testGit

git clean -f



