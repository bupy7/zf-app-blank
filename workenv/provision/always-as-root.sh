#!/usr/bin/env bash

# import script args
# ------------------
DB_TYPE=$(echo "$1")

# restart services
# ----------------
service php7.1-fpm restart
service nginx restart
case $DB_TYPE in
    mysql)
        service mysql restart
        ;;

    pgsql)
        service postgresql restart
        ;;
esac
