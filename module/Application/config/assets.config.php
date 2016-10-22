<?php

/**
 * Assets configuration file for Application module.
 */

use ZfcRbac\Guard\GuardInterface;

return [
    'assetic_configuration' => [
        'acceptableErrors' => [
            GuardInterface::GUARD_UNAUTHORIZED
        ],
        'debug' => APP_DEBUG,
        'buildOnRequest' => true,
        'webPath' => getcwd() . '/public/assets',
        'basePath' => 'assets',
        'default' => [
            'assets' => [
                '@library_css',
                '@app_css',
                '@library_js',
                '@common_js',
            ],
            'options' => [
                'mixin' => true,
            ],
        ],
        'modules' => [
            'Application' => [
                'root_path' => __DIR__ . '/../assets',
                'collections' => [
                    'common_js' => [
                        'assets' => [
                            'js/utils/*.js',
                            'js/locales/*.js',
                            'js/app.js',
                            'js/validations/callbacks/*.js',
                            'js/validations/messages/*.js',
                            'js/validations/*.js',
                        ],
                        'filters' => [
                            '?UglifyJs2Filter',
                        ],
                        'options' => [
                            'output' => 'js/common.min.js',
                        ],
                    ],
                    'library_js' => [
                        'assets' => [
                            getcwd() . '/vendor/bower/jquery/dist/jquery.min.js',
                            getcwd() . '/vendor/bower/bootstrap/dist/js/bootstrap.min.js',
                            getcwd() . '/vendor/bower/underscore/underscore-min.js',
                            getcwd() . '/vendor/bower/backbone/backbone-min.js',
                            getcwd() . '/vendor/bower/backbone.validation/dist/backbone-validation-min.js',
                            getcwd() . '/vendor/bower/i18next/i18next.min.js',
                            getcwd() . '/vendor/bower/js-lib-url/dist/url.min.js',
                        ],
                        'options' => [
                            'output' => 'js/library.min.js',
                        ],
                    ],
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
                            getcwd() . '/vendor/bower/font-awesome/css/font-awesome.css',
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
                            getcwd() . '/vendor/bower/bootstrap/fonts/*',
                        ],
                        'options' => [
                            'move_raw' => true,
                            'targetPath' => 'fonts',
                        ],
                    ],
                    'font_awesome_fonts' => [
                        'assets' => [
                            getcwd() . '/vendor/bower/font-awesome/fonts/*',
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
