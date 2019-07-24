#!/usr/bin/env bash
docker run -v $(pwd)/arquivei:/app \
-e DB_DATABASE=$1 -e DB_USERNAME=$2 -e DB_PASSWORD=$3 \
--network arquivei-challenge_default --rm php-fpm php artisan migrate