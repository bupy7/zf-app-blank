zf-app-blank
============

[![Latest Stable Version](https://poser.pugx.org/bupy7/zf-app-blank/v/stable)](https://packagist.org/packages/bupy7/zf-app-blank)
[![Latest Unstable Version](https://poser.pugx.org/bupy7/zf-app-blank/v/unstable)](https://packagist.org/packages/bupy7/zf-app-blank)
[![License](https://poser.pugx.org/bupy7/zf-app-blank/license)](https://packagist.org/packages/bupy7/zf-app-blank)

Autoloading standart [PSR-4](http://www.php-fig.org/psr/psr-4/). Coding standart [PSR-2](http://www.php-fig.org/psr/psr-2/).

![zf-app-blank](docs/screenshot.png)

Features
--------

- PHP7
- [Zend Framework 3](https://github.com/zendframework/zendframework)
- [Backbone.js](http://backbonejs.org/)
- [Bootstrap 3](http://getbootstrap.com/)
- [Doctrine ORM 2](http://www.doctrine-project.org/)
- [Debug Bar](https://github.com/snapshotpl/ZfSnapPhpDebugBar)
- [Twig](http://twig.sensiolabs.org/)
- [Assetic Management](https://github.com/kriswallsmith/assetic)
- [RBAC](https://github.com/ZF-Commons/zfc-rbac)
- [Flexible Form Builder](https://github.com/bupy7/zf-form)
- [Support Vagrant](https://www.vagrantup.com/)
- [Support Composer](https://getcomposer.org/)
- [Support Bower](https://bower.io/)
- [Database is PostgreSQL](https://www.postgresql.org/)
- [Database is MySQL](https://www.mysql.com/)
- [YUI Comressor](https://github.com/yui/yuicompressor)
- [UglifyJS2](https://github.com/mishoo/UglifyJS2)
- [PHP Coding Standarts Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
- Multilanguage (English and Russian).
- Simple example application (Sign in and Sign up).

Installation
------------

- Download and unpack the repository.

- [Install Vagrant](https://www.vagrantup.com/docs/installation/)

- Install plugins for Vagrant:

```
$ vagrant plugin install vagrant-vbguest
$ vagrant plugin install vagrant-hostmanager
```

- Run install the work environment:

```
$ vagrant up
```

- Paste GitHub token into `/workenv/config/vagrant-local.yml`

- Run again:

```
$ vagrant up
```

- Configure your projects into `/config/local.php`.

- Create the database schema:

```
$ vagrant ssh -c 'php bin/console orm:schema-tool:create'
```

- Done.

License
-------

zf-app-blank is released under the BSD 3-Clause License.
