<?php

use Zend\Mvc\Application;

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require_once 'vendor/autoload.php';

// Include constants of application
defined('APP_ENV') or define('APP_ENV', 'dev');
defined('APP_DEBUG') or define('APP_DEBUG', true);
require_once 'config/constants.php';

// Run the application!
Application::init(require 'config/application.config.php')->run();
