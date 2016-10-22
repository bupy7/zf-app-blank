<?php

/**
 * Сonfig file of Router for the Application module.
 */

use Zend\Router\Http\Literal;
use Application\Controller\IndexController;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
];
