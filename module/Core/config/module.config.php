<?php

/**
 * Main Application module config file.
 */

use Zend\Cache\Service\StorageCacheAbstractServiceFactory;
use Zend\Log\LoggerAbstractServiceFactory;
use Zend\Navigation\Service\NavigationAbstractServiceFactory;
use Zend\Mvc\I18n\TranslatorFactory;
use Core\Controller\Plugin\TranslatePluginFactory;
use Core\View\Helper\AlertMessageHelper;
use Core\View\Helper\LocaleHelperFactory;

return [
    'time_zone' => [
        'time_zone' => 'Europe/London',
    ],
    'service_manager' => [
        'abstract_factories' => [
            StorageCacheAbstractServiceFactory::class,
            LoggerAbstractServiceFactory::class,
            NavigationAbstractServiceFactory::class,
        ],
        'factories' => [
            'translator' => TranslatorFactory::class,
        ],
    ],
    'translator' => [
        'locale' => 'en',
        'translation_file_patterns' => [
            [
                'type' => 'phparray',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.php',
                'text_domain' => 'Core',
            ],
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            'translate' => TranslatePluginFactory::class,
        ],
    ],
    'view_manager' => [
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'locale' => LocaleHelperFactory::class,
        ],
        'invokables' => [
            'alertMessage' => AlertMessageHelper::class,
        ],
    ],
];
