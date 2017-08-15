<?php

namespace ExAssetic;

return [
    'cli' => [
        'commands' => [
            'ExAssetic\Command\BuildCommand',
            'ExAssetic\Command\SetupCommand',
        ],
    ],
    'command_manager' => [
        'factories' => [
            'ExAssetic\Command\BuildCommand' => Command\BuildCommandFactory::class,
            'ExAssetic\Command\SetupCommand' => Command\SetupCommandFactory::class,
        ],
    ],
];
