#!/usr/bin/env bash

# init
php bin/init --env=dev --overwrite=y

# database
sed -i 's/^\/\///' config/autoload/local.php
sed -i '17d' config/autoload/local.php
sed -i '15d' config/autoload/local.php
sed -i '8d' config/autoload/local.php

# mailgun config
url=$(curl -Ls -o /dev/null -w %{url_effective} http://bin.mailgun.net)
sed -i "s,endpoint-example,${url}," config/autoload/local.php

#packages
composer install --no-interaction
yarn install --non-interactive
