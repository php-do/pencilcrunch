FROM php:5.4-apache
MAINTAINER Pedro Sanders <sanderspedro@gmail.com>

RUN  export DEBIAN_FRONTEND="noninteractive"
RUN  bash -c "debconf-set-selections <<< 'mysql-server mysql-server/root_password password admin'"
RUN  bash -c "debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password admin'"

RUN  apt-get update && apt-get -y install mysql-server mysql-client php5-mysql
RUN  docker-php-ext-install mysqli pdo pdo_mysql
RUN  cp /usr/share/php5/php.ini-production /usr/local/etc/php/php.ini

COPY . /var/www/html/
ADD  etc/build/run.sh /app/
CMD  sh /app/run.sh && sleep infinity