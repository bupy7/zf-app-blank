<?php

/**
 * Local configuration of application.
 */

use Doctrine\DBAL\Driver\PDOPgSql\Driver as PgSQLDriver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => PgSQLDriver::class,
                'params' => [
                    'host' => '127.0.0.1',
                    'port' => 5432,
                    'user' => 'zf_app_blank',
                    'password' => '1234',
                    'dbname' => 'zf_app_blank',
                ],
            ],
        ],
    ],
    'translator' => [
        'locale' => 'en',
    ],
    'ex_assetic' => [
        'node_bin' => '/usr/bin/node',
        'node_paths' => [
            '/usr/lib/node_modules',
        ],
        'yui_path' => '/usr/share/yui-compressor/yui-compressor.jar',
        'java_path' => '/usr/bin/java',
    ],
];
