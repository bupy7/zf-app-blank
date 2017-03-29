<?php

/**
 * Local configuration of application.
 */

//use Doctrine\DBAL\Driver\PDOPgSql\Driver as PgSqlDriver;
use Doctrine\DBAL\Driver\PDOMySql\Driver as MySqlDriver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
//                'driverClass' => PgSqlDriver::class,
                'driverClass' => MySqlDriver::class,
                'params' => [
                    'host' => '127.0.0.1',
//                    'port' => 5432,
                    'port' => 3306,
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
        'yui_path' => '/usr/lib/node_modules/yuicompressor/build/yuicompressor-2.4.8.jar',
        'java_path' => '/usr/bin/java',
        'uglify_js2_path' => '/usr/bin/uglifyjs',
    ],
];
