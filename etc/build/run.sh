#!/usr/bin/env bash

DB_NAME='pencilcrunch'
DB_HOSTNAME='127.0.0.1'
DB_USER='pencilcrunch'
DB_PASSWORD='admin'

service apache2 start
service mysql start

sed -i "s/'hostname' => '',/'hostname' => '$DB_HOSTNAME',/" /var/www/html/application/config/database.php
sed -i "s/'database' => '',/'database' => '$DB_NAME',/" /var/www/html/application/config/database.php
sed -i "s/'username' => '',/'username' => '$DB_NAME',/" /var/www/html/application/config/database.php
sed -i "s/'password' => '',/'password' => '$DB_PASSWORD',/" /var/www/html/application/config/database.php
sed -i "s/= 'install';/= 'login';/" /var/www/html/application/config/routes.php

mysql -u root -padmin \
    -e "create database $DB_NAME; GRANT ALL PRIVILEGES ON $DB_NAME.* TO $DB_USER@localhost IDENTIFIED BY '$DB_PASSWORD'"

mysql $DB_NAME -u$DB_USER -p$DB_PASSWORD -e "source uploads/install.sql"
