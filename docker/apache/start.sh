#!/bin/bash

php artisan key:generate
#php artisan jwt:secret

php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan migrate --force
php artisan db:seed

touch storage/logs/laravel.log
chgrp -R www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache
chown www-data:www-data -R storage/logs/laravel.log
chmod 775 -R storage
ln -sf /proc/1/fd/1 /var/log/apache2/error.log

echo "ulimit"
ulimit -n

cron
#php artisan queue:restart
#php artisan queue:work --timeout=300 --tries=3

apache2-foreground