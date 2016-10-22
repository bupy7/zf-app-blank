<?php

/**
 * The ExDebugBar module configurations.
 */

use DebugBar\Bridge\DoctrineCollector;
use ExDebugBar\Collector\DoctrineCollectorFactory;
use ExDebugBar\Delegator\DoctrineConfigurationDelegatorFactory;

return [
    'php-debug-bar' => [
        'auto-append-assets' => false,
        'collectors' => [
            DoctrineCollector::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            DoctrineCollector::class => DoctrineCollectorFactory::class,
        ],
        'delegators' => [
            'doctrine.configuration.orm_default' => [
                DoctrineConfigurationDelegatorFactory::class,
            ],
        ],
    ],
];

