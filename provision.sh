#!/bin/bash

# Variables
db="mapage"
password="CqNrS6u!qBxGs8NvM#Gv"

# Create databases
echo "
    CREATE DATABASE ${db} CHARACTER SET utf8 COLLATE utf8_general_ci;
    CREATE USER '${db}'@'localhost' IDENTIFIED BY '${password}';

    GRANT ALL PRIVILEGES ON ${db}.* TO '${db}'@'localhost';
    GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root';
    FLUSH PRIVILEGES;
" | mysql -u root

key=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 32 | head -n 1)

echo "APP_ENV=local
APP_DEBUG=true
APP_KEY=${key}

DB_HOST=localhost
DB_DATABASE=${db}
DB_USERNAME=${db}
DB_PASSWORD=${password}

SITE_URL=http://mapage.dev

CACHE_DRIVER=file
SESSION_DRIVER=file

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
" > /var/www/.env

# Update Composer & Migrate Database
cd /var/www && sudo composer self-update && sudo composer install && php artisan migrate

# Add rewrite rules to Nginx
echo "echo 'server {
    listen 80 default_server;

    root /var/www/public;
    index index.php;

    server_name localhost;

    location / {
         try_files \$uri \$uri/ /index.php\$is_args\$args;
    }

    location ~ \.php\$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)\$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
}' > /etc/nginx/sites-available/default" | sudo sh
sudo nginx -s reload

# Remove bind address - allows remote MySQL
sudo sed -r -i "s/bind\-address/#bind\-address/" /etc/mysql/my.cnf
sudo service mysql restart
