#!/bin/bash

#php artisan key:generate
#php artisan jwt:secret
php composer.phar dump-autoload
php artisan cache:clear
php artisan config:cache
php artisan route:cache

chgrp -R www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache
chown www-data:www-data -R storage/log
chmod 775 -R storage

echo "Start apache"
service apache2 start
cron
php artisan queue:work --timeout=300 --tries=3
