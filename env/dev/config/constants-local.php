<?php

/**
 * Defined local constants.
 */

/**
 * The enviroment constant. You can set as `true` only one enviroment!
 * Description:
 * - `APP_ENV_DEV` - development enviroment
 * - `APP_ENV_PROD` - production enviroment
 */
defined('APP_ENV_DEV') or define('APP_ENV_DEV', true);
defined('APP_ENV_PROD') or define('APP_ENV_PROD', false);

/**
 * Debug mode of application: on(true)/off(false).
 */
defined('APP_DEBUG') or define('APP_DEBUG', true);
