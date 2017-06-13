<?php

/**
 * The enviroment constant.
 * Values: 'dev', 'test', 'prod'.
 */
defined('APP_ENV') or define('APP_ENV', 'prod');

/**
 * Description:
 * - `APP_ENV_DEV` - development enviroment
 * - `APP_ENV_PROD` - production enviroment
 * - `APP_ENV_TEST` - test environment
 */
defined('APP_ENV_DEV') or define('APP_ENV_DEV', APP_ENV == 'dev');
defined('APP_ENV_PROD') or define('APP_ENV_PROD', APP_ENV == 'prod');
defined('APP_ENV_TEST') or define('APP_ENV_TEST', APP_ENV == 'test');

/**
 * Debug mode of application: on(true)/off(false).
 */
defined('APP_DEBUG') or define('APP_DEBUG', false);
