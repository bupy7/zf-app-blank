<?php

/**
 * Main Application module config file.
 */

use Zend\Cache\Service\StorageCacheAbstractServiceFactory;
use Zend\Log\LoggerAbstractServiceFactory;
use Zend\Navigation\Service\NavigationAbstractServiceFactory;
use Zend\Mvc\I18n\TranslatorFactory;
use Zend\ServiceManager\Factory\InvokableFactory;
use Application\Controller\Plugin\TranslatePluginFactory;
use Application\View\Helper\AlertMessageHelper;
use Application\Controller\IndexController;
use Application\View\Helper\LocaleHelperFactory;

return [
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
                'text_domain' => 'Application',
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => InvokableFactory::class,
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
