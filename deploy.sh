#!/bin/sh
set -e
git reset --hard HEAD^
git pull
docker-compose exec php composer install
docker exec titar_php php artisan migrate --force
