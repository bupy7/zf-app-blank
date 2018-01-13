#!/usr/bin/env bash

phpenv config-rm xdebug.ini

# init
php bin/init --env=dev --overwrite=y

# mailgun config
url=$(curl -Ls -o /dev/null -w %{url_effective} http://bin.mailgun.net)
sed -i "s,endpoint-example,${url}," config/autoload/local.php

#packages
composer install --no-interaction
yarn install --non-interactive
