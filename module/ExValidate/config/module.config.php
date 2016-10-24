<?php

/**
 * The ExValidate module configurations.
 */

use ExValidate\Delegator\TranslatorDelegatorFactory;

return [
    'service_manager' => [
        'delegators' => [
            'translator' => [
                TranslatorDelegatorFactory::class,
            ],
        ],
    ],
];
