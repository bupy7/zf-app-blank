<?php

/**
 * Configuration for this module and basic config of the `Twig`.
 */

use Zend\View\Helper\Partial;
use Bupy7\Form\View\Helper\FormBuilderHelper;
use Bupy7\Form\View\Helper\FormBuilderHelperFactory;

return [
    'zfctwig' => [
        'environment_options' => [
            'autoescape' => false,
            'strict_variables' => true,
        ],
        'extensions' => [
            'debug' => Twig_Extension_Debug::class,
        ],
        'helper_manager' => [
            'invokables' => [
                'partial' => Partial::class,
            ],
            'factories' => [
                FormBuilderHelper::class => FormBuilderHelperFactory::class,
            ],
            'shared' => [
                'formBuilder' => false,
                FormBuilderHelper::class => false,
            ],
            'aliases' => [
                'formBuilder' => FormBuilderHelper::class,
            ],
        ],
    ],
];
