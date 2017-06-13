<?php

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use User\Controller\AuthController;
use User\Controller\SignupController;
use User\Controller\ConfirmEmailController;
use User\Controller\AccessController;

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
            'confirm-email' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/confirm-email/:e/:k',
                    'defaults' => [
                        'controller' => ConfirmEmailController::class,
                        'action' => 'confirm',
                    ],
                ],
            ],
            'confirm-again' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/confirm-again',
                    'defaults' => [
                        'controller' => ConfirmEmailController::class,
                        'action' => 'again',
                    ],
                ],
            ],
            'forgot-pass' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/forgot-pass',
                    'defaults' => [
                        'controller' => AccessController::class,
                        'action' => 'forgot-pass',
                    ],
                ],
            ],
            'restore-pass' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/restore-pass/:e/:k',
                    'defaults' => [
                        'controller' => AccessController::class,
                        'action' => 'restore-pass',
                    ],
                ],
            ],
        ],
    ],
];
