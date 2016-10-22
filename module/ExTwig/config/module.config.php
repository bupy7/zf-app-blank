<?php

/**
 * The ExTwig module configurations.
 */

use ExTwig\Extension\ClassExtension;

return [
    'zfctwig' => [
        'extensions' => [
            'class' => ClassExtension::class,
        ],
    ],
];
