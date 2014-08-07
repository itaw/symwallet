git pull
/usr/composer install
php app/console doctrine:schema:update --force
php app/console cache:clear --env=prod --no-debug