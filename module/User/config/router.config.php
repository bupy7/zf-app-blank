<?php

/**
 * Сonfig file of Router for the User module.
 */

use Zend\Router\Http\Literal;
use User\Controller\AuthController;
use User\Controller\SignupController;

return [
    'router' => [
        'routes' => [
            'signin' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/signin',
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action' => 'signin',
                    ],
                ],
            ],
            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/logout',
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action' => 'logout',
                    ],
                ],
            ],
            'signup' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/signup',
                    'defaults' => [
                        'controller' => SignupController::class,
                        'action' => 'signup',
                    ],
                ],
            ],
            'signup-email-valid' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/signup/email-valid',
                    'defaults' => [
                        'controller' => SignupController::class,
                        'action' => 'email-valid',
                    ],
                ],
            ],
        ],
    ],
];
