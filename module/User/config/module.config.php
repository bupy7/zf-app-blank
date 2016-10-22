<?php

/**
 * Main User module config file.
 */

use User\Controller\AuthControllerFactory;
use User\Controller\SignupControllerFactory;
use User\Service\AuthServiceFactory;
use Zend\Authentication\AuthenticationService;
use User\Form\SignUpForm;
use User\Form\SignUpFormFactory;
use User\Service\PasswordHashService;
use User\Service\PasswordHashServiceFactory;
use User\Controller\AuthController;
use User\Controller\SignupController;
use User\Service\SignUpServiceFactory;
use User\Service\SignUpService;

return [
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'phparray',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.php',
                'text_domain' => 'User',
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'controllers' => [
        'factories' => [
            AuthController::class => AuthControllerFactory::class,
            SignupController::class => SignupControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            AuthenticationService::class => AuthServiceFactory::class,
            SignUpForm::class => SignUpFormFactory::class,
            PasswordHashService::class => PasswordHashServiceFactory::class,
            SignUpService::class => SignUpServiceFactory::class,
        ],
    ],
];

