<?php

/**
 * Assets configuration file for Application module.
 */

use ZfcRbac\Guard\GuardInterface;

$npmPath = getcwd() . '/vendor/npm-asset';

return [
    'assetic_configuration' => [
        'acceptableErrors' => [
            GuardInterface::GUARD_UNAUTHORIZED
        ],
        'debug' => APP_DEBUG,
        'buildOnRequest' => APP_ENV_DEV,
        'webPath' => getcwd() . '/public/assets',
        'basePath' => 'assets',
        'default' => [
            'assets' => [
                '@library_css',
                '@app_css'
            ],
            'options' => [
                'mixin' => true,
            ],
        ],
        'modules' => [
            'Application' => [
                'root_path' => __DIR__ . '/../assets',
                'collections' => [
                    'app_css' => [
                        'assets' => [
                            'css/style.less',
                        ],
                        'filters' => [
                            'LessFilter',
                            '?CssCompressorFilter',
                        ],
                        'options' => [
                            'output' => 'css/app.min.css',
                        ],
                    ],
                    'library_css' => [
                        'assets' => [
                            'css/bs/bootstrap.less',
                            $npmPath . '/font-awesome/css/font-awesome.css',
                        ],
                        'filters' => [
                            'LessFilter',
                            '?CssCompressorFilter',
                        ],
                        'options' => [
                            'output' => 'css/library.min.css',
                        ],
                    ],
                    'app_images' => [
                        'assets' => [
                            'img/*',
                        ],
                        'options' => [
                            'move_raw' => true,
                        ],
                    ],
                    'bootstrap_fonts' => [
                        'assets' => [
                            $npmPath . '/bootstrap/fonts/*',
                        ],
                        'options' => [
                            'move_raw' => true,
                            'targetPath' => 'fonts',
                        ],
                    ],
                    'font_awesome_fonts' => [
                        'assets' => [
                            $npmPath . '/font-awesome/fonts/*',
                        ],
                        'options' => [
                            'move_raw' => true,
                            'targetPath' => 'fonts',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
