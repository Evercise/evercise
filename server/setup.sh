echo "START MAILCATCHER"
mailcatcher --ip=0.0.0.0

echo "Seting PERMISSIONS"
cd /var/www/html

chmod 777 -R app/storage/*

php artisan clear-compiled

php artisan ide-helper:generate

php artisan optimize

php artisan assets:clean