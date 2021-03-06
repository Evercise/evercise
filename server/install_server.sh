sudo su


# create the old database
mysql -uroot -f -e "DROP DATABASE IF EXISTS evercise"
mysql -uroot -f -e "DROP DATABASE IF EXISTS evercise_v1"

echo "CREATE DATABASE evercise;" | mysql -u root
echo "CREATE DATABASE evercise_v1;" | mysql -u root

mysql -u root evercise_v1 < /var/www/html/server/evercisedb_v1.sql
mysql -u root evercise < /var/www/html/server/evercise.sql


mkdir /var/www/hosts/

touch /var/www/hosts/evercise.conf

# Setup hosts file
VHOST=$(cat <<EOF
<VirtualHost *:80>
  DocumentRoot "/var/www/html/public"
  ServerName dev.evercise.com
  SetEnv ENVIRONMENT production
  <Directory "/var/www/html/public">
    AllowOverride All
  </Directory>
</VirtualHost>
EOF
)
echo "${VHOST}" > /var/www/hosts/evercise.conf

service httpd restart