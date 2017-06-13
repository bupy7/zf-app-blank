#!/usr/bin/env bash

# import script args
# ------------------
GITHUB_TOKEN=$(echo "$1")

# common
# ------
cd /vagrant

# composer
# --------
composer config --global github-oauth.github.com ${GITHUB_TOKEN}
composer install

# init project
# ------------
php bin/init --env=dev --overwrite=y
