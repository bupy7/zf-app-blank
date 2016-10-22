#!/usr/bin/env bash

. /vagrant/workenv/bootstrap.conf

# env
# ---
export DEBIAN_FRONTEND=noninteractive

# common
# ------
apt-get update
apt-get -y install curl

# hostname
# --------
old_hostname=$(hostname)
new_hostname=$SERVER_HOSTNAME
for file in \
    /etc/exim4/update-exim4.conf.conf \
    /etc/hostname \
    /etc/hosts \
    /etc/ssh/ssh_host_rsa_key.pub \
    /etc/ssh/ssh_host_dsa_key.pub
do
    if [ -f $file ]; then
        sed -i "s/${old_hostname}/${new_hostname}/g" $file
    fi
done
/etc/init.d/hostname.sh
service networking force-reload

# locale
# ------
server_locale=$(echo $SERVER_LOCALE | sed 's/\./\\&/')
sed -i "s/^#\s${server_locale}/${SERVER_LOCALE}/" /etc/locale.gen
locale-gen

# time zone
# ---------
echo $TIME_ZONE > /etc/timezone
dpkg-reconfigure -f noninteractive tzdata

# git
apt-get -y install git

# postgresql
# ----------
echo "deb http://apt.postgresql.org/pub/repos/apt/ $(lsb_release -sc)-pgdg main" > /etc/apt/sources.list.d/postgresql.list
wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add -
apt-get update
apt-get -y install postgresql-9.6 postgresql-client-9.6
pg_dropcluster --stop 9.6 main
pg_createcluster --locale $PGSQL_LOCALE --start 9.6 main
sudo -u postgres psql -c "CREATE USER ${PGSQL_USERNAME} WITH SUPERUSER CREATEDB LOGIN PASSWORD '${PGSQL_PASSWORD}';"
sudo -u postgres psql -c "CREATE DATABASE ${PGSQL_DATABASE};"
sed -i "s/^#listen_addresses.*/listen_addresses = '*'/" /etc/postgresql/9.6/main/postgresql.conf
echo "host all all 0.0.0.0/0 md5" >> /etc/postgresql/9.6/main/pg_hba.conf
service postgresql restart

# nginx
# -----
apt-get -y install nginx
cat "/vagrant/workenv/site.conf" > /etc/nginx/sites-available/default
service nginx restart

# php7 and php-fpm
# -------
echo "deb http://packages.dotdeb.org $(lsb_release -sc) all" > /etc/apt/sources.list.d/dotdeb.list
echo "deb-src http://packages.dotdeb.org $(lsb_release -sc) all" >> /etc/apt/sources.list.d/dotdeb.list
wget http://www.dotdeb.org/dotdeb.gpg -O- | apt-key add -
apt-get update
apt-get -y install php7.0-fpm php7.0-cli php7.0-bcmath php7.0-curl \
    php7.0-intl php7.0-json php7.0-mbstring php7.0-opcache php7.0-pgsql \
    php7.0-xdebug php7.0-mcrypt php7.0-gd php7.0-bz2 php7.0-zip php7.0-xml
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
    esc_tz=$(echo $TIME_ZONE | sed 's/\//\\&/')
    sed -i "s/^;date\.timezone.*/date.timezone=${esc_tz}/" $ini_file
}
php_ini_set /etc/php/7.0/fpm/php.ini
php_ini_set /etc/php/7.0/cli/php.ini
service php7.0-fpm restart

# composer
# --------
apt-get -y install curl
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
echo "export COMPOSER_DISABLE_XDEBUG_WARN=1" >> /home/vagrant/.profile
if [ -n $GITHUB_OAUTH_TOKEN ]; then
    composer config -g github-oauth.github.com $GITHUB_OAUTH_TOKEN
fi

# node.js
# ------
curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash -
apt-get -y install nodejs build-essential

# bower
# -----
npm install -g bower

# yui compressor
# --------------
npm install -g yuicompressor

# uglifyjs 2
# ----------
npm install -g uglify-js

# less
# ----
npm install -g less

# link to site
# ------------
rm -rf /var/www/html
ln -s /vagrant /var/www/html

# reset home directory
# --------------------
echo "cd /var/www/html" >> /home/vagrant/.profile
