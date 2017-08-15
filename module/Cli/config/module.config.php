<?php

namespace Cli;

return [
    'cli' => [
        'commands' => [],
    ],
    'command_manager' => [],
    'service_manager' => [
        'factories' => [
            Manager\CommandManager::class => Manager\CommandManagerFactory::class,
            Options\ModuleOptions::class => Options\ModuleOptionsFactory::class,
        ],
        'aliases' => [
            'CommandManager' => Manager\CommandManager::class,
        ],
    ],
];
