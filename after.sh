#!/bin/bash

set -e

# If AFTER_CWD is set, change into that directory
AFTER_CWD=${AFTER_CWD:-.}
cd $AFTER_CWD

cp .env.acceptance .env
composer install -n --prefer-dist
if [ ! -f ~/.key_generated ]; then
  php artisan key:generate;
  touch ~/.key_generated;
fi;

if [ -z ${DB_DATABASE+x} ]; then
  echo "DB_DATABASE not set, skipping migration";
else
  php artisan migrate;
fi
