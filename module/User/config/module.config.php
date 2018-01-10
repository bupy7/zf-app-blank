<?php

namespace User;

use Zend\Mvc\Controller\LazyControllerAbstractFactory;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'phparray',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.php',
                'text_domain' => __NAMESPACE__,
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'template_map' => [
            'user/mail/confirm-request' => __DIR__ . '/../view/mail/confirm-request.twig',
            'user/mail/restore-pass' => __DIR__ . '/../view/mail/restore-pass.twig'
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\AuthController::class => Controller\AuthControllerFactory::class,
            Controller\SignupController::class => Controller\SignupControllerFactory::class,
            Controller\ConfirmEmailController::class => Controller\ConfirmEmailControllerFactory::class,
            Controller\AccessController::class => Controller\AccessControllerFactory::class,
            Controller\IndexController::class => LazyControllerAbstractFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Form\SignUpForm::class => Form\SignUpFormFactory::class,

            \Zend\Authentication\AuthenticationService::class => Service\AuthServiceFactory::class,
            Service\SignUpService::class => Service\SignUpServiceFactory::class,
            Service\ConfirmEmailService::class => Service\ConfirmEmailServiceFactory::class,
            Service\AccessService::class => Service\AccessServiceFactory::class,

            \Zend\Crypt\Password\BcryptSha::class => \Zend\ServiceManager\Factory\InvokableFactory::class,

            Search\UserSearch::class => ReflectionBasedAbstractFactory::class,
        ],
        'aliases' => [
            'User\Crypt\PasswordCrypt' => \Zend\Crypt\Password\BcryptSha::class,
        ],
    ],
];
