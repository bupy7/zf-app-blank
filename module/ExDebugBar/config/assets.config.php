<?php

/**
 * Assets configuration file for ExDebugBar module.
 */

return [
    'assetic_configuration' => [
        'routes' => [
            '.*' => [
                '@ex_debugbar_css',
                '@ex_debugbar_js',
            ],
        ],
        'modules' => [
            'ExDebugBar' => [
                'root_path' => __DIR__ . '/../assets',
                'collections' => [
                    'ex_debugbar_js' => [
                        'assets' => [
                            getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources/vendor/highlightjs/highlight.pack.js',
                            getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources/debugbar.js',
                            getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources/widgets.js',
                            getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources/openhandler.js',
                            getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources/widgets/sqlqueries/widget.js',
                        ],
                        'options' => [
                            'output' => 'js/ex-debugbar.js',
                        ],
                    ],
                    'ex_debugbar_css' => [
                        'assets' => [
                            getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources/vendor/font-awesome/css/font-awesome.min.css',
                            getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources/vendor/highlightjs/styles/github.css',
                            getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources/debugbar.css',
                            getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources/widgets.css',
                            getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources/openhandler.css',
                            getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources/widgets/sqlqueries/widget.css',
                            getcwd() . '/vendor/snapshotpl/zf-snap-php-debug-bar/assets/zf-snap-php-debug-bar.css',
                        ],
                        'options' => [
                            'output' => 'css/ex-debugbar.css',
                        ],
                    ],
                ],
            ],
        ],
    ],
];