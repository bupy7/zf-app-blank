#!/usr/bin/env bash

MYSQL_USER=zf_app_blank
MYSQL_PASS=1234
MYSQL_DB=zf_app_blank

# common
# ------
apt-get -y install curl

# mysql
# -----
apt-key adv --keyserver ha.pool.sks-keyservers.net --recv-keys 5072E1F5
echo "deb http://repo.mysql.com/apt/ubuntu/ $(lsb_release -sc) mysql-5.7" > /etc/apt/sources.list.d/mysql.list
apt-get update
debconf-set-selections <<< 'mysql-community-server mysql-community-server/root-pass password rootpass'
debconf-set-selections <<< 'mysql-community-server mysql-community-server/re-root-pass password rootpass'
apt-get -y install mysql-server
echo "CREATE DATABASE ${MYSQL_DB}_test" | mysql -uroot -prootpass 2>/dev/null
echo "CREATE USER '${MYSQL_USER}'@'localhost' IDENTIFIED BY '${MYSQL_PASS}'" | mysql -uroot -prootpass 2>/dev/null
echo "GRANT ALL PRIVILEGES ON *.* TO '${MYSQL_USER}'@'localhost' WITH GRANT OPTION" | mysql -uroot -prootpass 2>/dev/null
echo "FLUSH PRIVILEGES" | mysql -uroot -prootpass 2>/dev/null
echo '[mysqld]' >> /etc/mysql/mysql.conf.d/mysqld.cnf
echo 'collation-server=utf8_unicode_ci' >> /etc/mysql/mysql.conf.d/mysqld.cnf
echo 'character-set-server=utf8' >> /etc/mysql/mysql.conf.d/mysqld.cnf
echo "skip-character-set-client-handshake" >> /etc/mysql/mysql.conf.d/mysqld.cnf
service mysql restart

# node.js
# ------
curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash -
apt-get -y install nodejs build-essential

# java
# ----
apt-get -y install default-jre-headless java-wrappers libjargs-java

# yarn
# ----
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
apt-get update
apt-get -y install yarn

# yui compressor
# --------------
npm install -g yuicompressor

# uglifyjs 2
# ----------
npm install -g uglify-js

# ruby and gem
# ------------
apt-get -y install software-properties-common
apt-add-repository -y ppa:brightbox/ruby-ng
apt-get update
apt-get -y install ruby2.4-dev ruby2.4

# sass
# ----
gem install sass --no-user-install
