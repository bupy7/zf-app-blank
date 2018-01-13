<?php

/**
 * Global application configuration file.
 */

return [
    // The Application module configurations.
    'view_manager' => [
        'display_exceptions' => APP_DEBUG,
        'display_not_found_reason' => APP_DEBUG,
    ],
    // The ZfcTwig module configurations.
    'zfctwig' => [
        'environment_options' => [
            'debug' => APP_DEBUG,
        ],
    ],
    // The ZfSnapPhpDebugBar moduleconfigurations.
    'php-debug-bar' => [
        'enabled' => APP_ENV_DEV,
    ],
];
