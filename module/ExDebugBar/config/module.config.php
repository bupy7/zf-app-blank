<?php

/**
 * The ExDebugBar module configurations.
 */

use DebugBar\Bridge\DoctrineCollector;
use ZfSnapPhpDebugBar\Delegator\DoctrineConfigurationDelegatorFactory;

return [
    'php-debug-bar' => [
        'auto-append-assets' => false,
        'collectors' => [
            DoctrineCollector::class,
        ],
    ],
    'service_manager' => [
        'delegators' => [
            'doctrine.configuration.orm_default' => [
                DoctrineConfigurationDelegatorFactory::class,
            ],
        ],
    ],
];
