#!/usr/bin/env bash

# import script args
# ------------------
SERVER_TIME_ZONE=$(echo "$1")
MYSQL_DB=$(echo "$2")
MYSQL_USER=$(echo "$3")
MYSQL_PASS=$(echo "$4")
PHP_TIME_ZONE=$(echo "$5")
PHP_MEMORY_LIMIT=$(echo "$6")
PHP_EXECUTION_TIME=$(echo "$7")
PHP_INPUT_TIME=$(echo "$8")
SERVER_LOCALE=$(echo "$9")
PGSQL_DB=$(echo "${10}")
PGSQL_USER=$(echo "${11}")
PGSQL_PASS=$(echo "${12}")
PGSQL_LOCALE=$(echo "${13}")
DB_TYPE=$(echo "${14}")
XDEBUG_IDEKEY=$(echo "${15}")
MACHINE_IP=$(echo "${16}")

# env
# ---
export DEBIAN_FRONTEND=noninteractive

# common
# ------
apt-get update
apt-get upgrade -y
apt-get -y install curl

# locale
# ------
server_locale=$(echo $SERVER_LOCALE | sed 's/\./\\&/')
sed -i "s/^#\s${server_locale}/${SERVER_LOCALE}/" /etc/locale.gen
locale-gen

# time zone
# ---------
echo ${SERVER_TIME_ZONE} > /etc/timezone
dpkg-reconfigure -f noninteractive tzdata

# git
# ---
apt-get -y install git

# database
# --------
case $DB_TYPE in
    mysql)
        apt-key adv --keyserver ha.pool.sks-keyservers.net --recv-keys 5072E1F5
        echo "deb http://repo.mysql.com/apt/debian/ $(lsb_release -sc) mysql-5.7" > /etc/apt/sources.list.d/mysql.list
        apt-get update
        debconf-set-selections <<< 'mysql-community-server mysql-community-server/root-pass password rootpass'
        debconf-set-selections <<< 'mysql-community-server mysql-community-server/re-root-pass password rootpass'
        apt-get -y install mysql-server
        echo "CREATE USER '${MYSQL_USER}'@'%' IDENTIFIED BY '${MYSQL_PASS}'" | mysql -uroot -prootpass 2>/dev/null
        echo "GRANT ALL PRIVILEGES ON *.* TO '${MYSQL_USER}'@'%' WITH GRANT OPTION" | mysql -uroot -prootpass 2>/dev/null
        echo "FLUSH PRIVILEGES" | mysql -uroot -prootpass 2>/dev/null
        sed -i 's/^bind-address.*/bind-address=0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf
        echo '[mysqld]' >> /etc/mysql/mysql.conf.d/mysqld.cnf
        echo 'collation-server=utf8_unicode_ci' >> /etc/mysql/mysql.conf.d/mysqld.cnf
        echo 'character-set-server=utf8' >> /etc/mysql/mysql.conf.d/mysqld.cnf
        echo "skip-character-set-client-handshake" >> /etc/mysql/mysql.conf.d/mysqld.cnf
        service mysql restart
        echo "CREATE DATABASE ${MYSQL_DB}" | mysql -uroot -prootpass 2>/dev/null
        echo "CREATE DATABASE ${MYSQL_DB}_test" | mysql -uroot -prootpass 2>/dev/null
        ;;

    pgsql)
        echo "deb http://apt.postgresql.org/pub/repos/apt/ $(lsb_release -sc)-pgdg main" > /etc/apt/sources.list.d/postgresql.list
        wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add -
        apt-get update
        apt-get -y install postgresql-9.6 postgresql-client-9.6
        pg_dropcluster --stop 9.6 main
        pg_createcluster --locale $PGSQL_LOCALE --start 9.6 main
        sudo -u postgres psql -c "CREATE USER ${PGSQL_USER} WITH SUPERUSER CREATEDB LOGIN PASSWORD '${PGSQL_PASS}';"
        sudo -u postgres psql -c "CREATE DATABASE ${PGSQL_DB};"
        sudo -u postgres psql -c "CREATE DATABASE ${PGSQL_DB}_test;"
        sed -i "s/^#listen_addresses.*/listen_addresses = '*'/" /etc/postgresql/9.6/main/postgresql.conf
        echo "host all all 0.0.0.0/0 md5" >> /etc/postgresql/9.6/main/pg_hba.conf
        service postgresql restart
        ;;
esac

# nginx
# -----
apt-get -y install nginx
rm /etc/nginx/sites-available/default
ln -s /vagrant/workenv/nginx/site.conf /etc/nginx/sites-available/default
service nginx restart

# php7.1 and php-fpm
# -------
apt-get -y install apt-transport-https lsb-release ca-certificates
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list
echo "deb-src https://packages.sury.org/php/ $(lsb_release -sc) main" >> /etc/apt/sources.list.d/php.list
wget https://packages.sury.org/php/apt.gpg -O- | apt-key add -
apt-get update
apt-get -y install php7.1-fpm php7.1-cli php7.1-bcmath php7.1-curl \
    php7.1-intl php7.1-json php7.1-mbstring php7.1-opcache \
    php7.1-xdebug php7.1-mcrypt php7.1-gd php7.1-bz2 php7.1-zip php7.1-xml
case $DB_TYPE in
    mysql)
        apt-get -y install php7.1-mysql
        ;;

    pgsql)
        apt-get -y install php7.1-pgsql
        ;;
esac
php_ini_set() {
    ini_file=$1
    if [[ $ini_file == *'fpm'* ]]; then
        sed -i "s/^memory_limit.*/memory_limit=${PHP_MEMORY_LIMIT}/" $ini_file
        sed -i 's/^;cgi.fix_pathinfo.*/cgi.fix_pathinfo=0/' $ini_file
    fi
    sed -i "s/^max_execution_time.*/max_execution_time=${PHP_EXECUTION_TIME}/" $ini_file
    sed -i "s/^max_input_time.*/max_input_time=${PHP_INPUT_TIME}/" $ini_file
    sed -i 's/^error_reporting.*/error_reporting=E_ALL/' $ini_file
    sed -i 's/^display_errors.*/display_errors=On/' $ini_file
    sed -i 's/^display_startup_errors.*/display_startup_errors=On/' $ini_file
    sed -i 's/^track_errors.*/track_errors=On/' $ini_file
    esc_tz=$(echo $PHP_TIME_ZONE | sed 's/\//\\&/')
    sed -i "s/^;date\.timezone.*/date.timezone=${esc_tz}/" $ini_file
}
php_ini_set /etc/php/7.1/fpm/php.ini
php_ini_set /etc/php/7.1/cli/php.ini
xdebug_set() {
    ini_file=$1
    ide_key=$2
    remote_host=$3

    xdebug=$(cat <<EOF
xdebug.remote_enable=1
xdebug.remote_connect_back=1
xdebug.remote_log=/tmp/php7.1-xdebug.log
xdebug.idekey=${ide_key}
xdebug.remote_host=${remote_host}
xdebug.max_nesting_level=1000
EOF
)

    echo "${xdebug}" > $ini_file
}
foreign_ip=$(netstat -rn | grep "^0.0.0.0 " | cut -d " " -f10)
xdebug_set /etc/php/7.1/cli/conf.d/50-xdebug.ini $XDEBUG_IDEKEY $foreign_ip
xdebug_set /etc/php/7.1/fpm/conf.d/50-xdebug.ini $XDEBUG_IDEKEY $MACHINE_IP
service php7.1-fpm restart

# composer
# --------
apt-get -y install curl
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
echo "export COMPOSER_DISABLE_XDEBUG_WARN=1" >> /home/vagrant/.profile

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
apt-get -y install ruby-full

# sass
# ----
gem install sass --no-user-install

# link to site
# ------------
rm -rf /var/www/html
ln -s /vagrant /var/www/html

# reset home directory
# --------------------
echo "cd /var/www/html" >> /home/vagrant/.profile
