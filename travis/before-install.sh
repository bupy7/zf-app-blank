#!/usr/bin/env bash

# common
# ------
apt-get -y install curl

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
