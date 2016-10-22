<?php

/**
 * Configuration for this module and basic config of the `DoctrineOrmModule` and `DoctrineModule`.
 */

return [
    'doctrine' => [
        'migrations_configuration' => [
            'orm_default' => [
                'directory' => getcwd() . '/data/migrations',
                'name' => 'Doctrine Database Migrations',
                'namespace' => 'DoctrineORMModule\Migrations',
                'table' => 'migration',
                'column' => 'version',
            ],
        ],
    ],
];
