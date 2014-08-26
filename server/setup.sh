echo "START MAILCATCHER"
mailcatcher

echo "Seting PERMISSIONS"
cd /var/www/html

chown apache:apache -R app/storage/cache/
chown apache:apache -R app/storage/logs/
chown apache:apache -R app/storage/meta/
chown apache:apache -R app/storage/sessions/
chown apache:apache -R app/storage/views/

php artisan migrate:reset --env=vagrant

php artisan migrate --package=cartalyst/sentry

php artisan migrate --env=vagrant

php artisan db:seed --env=vagrant

php artisan clear-compiled

php artisan ide-helper:generate

php artisan optimize