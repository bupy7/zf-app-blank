<?php

namespace Mail;

return [
    'mail' => [
        'supportEmail' => 'no-reply@zf-app-blank.com',
    ],
    'mailgun' => [
        'hydrator' => Hydrator\ModelHydrator::class,
    ],
    'service_manager' => [
        'factories' => [
            Service\MailService::class => Service\MailServiceFactory::class,
            Options\ModuleOptions::class => Options\ModuleOptionsFactory::class,
            Message\MessageBuilder::class => Message\MessageBuilderFactory::class,
        ],
        'shared' => [
            Message\MessageBuilder::class => false,
        ],
    ],
];
