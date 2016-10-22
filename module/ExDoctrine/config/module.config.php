<?php

/**
 * The ExDoctrine module configurations.
 */

use ExDoctrine\Hydrator\ObjectHydratorFactory;

return [
    'service_manager' => [
        'factories' => [
            'ExDoctrine\Hydrator\ObjectHydrator' => ObjectHydratorFactory::class,
        ],
    ],
];
