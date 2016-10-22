<?php

use Zend\Mvc\Application;

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'vendor/autoload.php';

// Include constants of application
require_once 'config/constants-local.php';
require_once 'config/constants.php';

// Run the application!
Application::init(require 'config/application.config.php')->run();

