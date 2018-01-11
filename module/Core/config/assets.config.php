<?php

/**
 * Assets configuration file for Application module.
 */

use ZfcRbac\Guard\GuardInterface;

$npmPath = getcwd() . '/node_modules';

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
                '@library_js',

                '@app_css',
                '@app_js',
            ],
            'options' => [
                'mixin' => true,
            ],
        ],
        'modules' => [
            'Core' => [
                'root_path' => __DIR__ . '/../assets',
                'collections' => [
                    'app_css' => [
                        'assets' => [
                            'css/style.sass',
                        ],
                        'filters' => [
                            'SassFilter',
                            '?CssCompressorFilter',
                        ],
                        'options' => [
                            'output' => 'css/app.min.css',
                        ],
                    ],
                    'app_js' => [
                        'assets' => [
                            'js/navbar.js',
                        ],
                        'filters' => [
                            '?UglifyJs2Filter',
                        ],
                        'options' => [
                            'output' => 'js/app.min.js',
                        ],
                    ],
                    'library_js' => [
                        'assets' => [
                            $npmPath . '/bootstrap.native/dist/bootstrap-native-v4.js',
                        ],
                        'filters' => [
                            '?UglifyJs2Filter',
                        ],
                        'options' => [
                            'output' => 'js/library.min.js',
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
                    'font_awesome_fonts' => [
                        'assets' => [
                            $npmPath . '/font-awesome/fonts/*',
                        ],
                        'options' => [
                            'move_raw' => true,
                            'targetPath' => 'fonts',
                            'disable_source_path' => true,
                        ],
                    ],
                ],
            ],
        ],
    ],
];
