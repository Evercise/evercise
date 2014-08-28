echo "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;" | mysql -u root
echo "FLUSH PRIVILEGES;" | mysql -u root


echo "Moving Config Files"
sudo \cp -r /var/www/html/server/my.cnf /etc/my.cnf
sudo \cp -r /var/www/html/server/php.ini /etc/php.ini


sudo service httpd restart
sudo service mysqld restart


echo "START MAILCATCHER"
mailcatcher --ip=0.0.0.0

echo "Seting PERMISSIONS"
cd /var/www/html

php artisan clear-compiled

php artisan ide-helper:generate

php artisan optimize

php artisan assets:clean