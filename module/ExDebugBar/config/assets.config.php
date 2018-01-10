<?php

/**
 * Assets configuration file for ExDebugBar module.
 */

$debugBarRes = getcwd() . '/vendor/maximebf/debugbar/src/DebugBar/Resources';

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
                            getcwd() . '/node_modules/jquery/dist/jquery.min.js',
                            $debugBarRes . '/vendor/highlightjs/highlight.pack.js',
                            $debugBarRes . '/debugbar.js',
                            $debugBarRes . '/widgets.js',
                            $debugBarRes . '/openhandler.js',
                            $debugBarRes . '/widgets/sqlqueries/widget.js',
                        ],
                        'options' => [
                            'output' => 'js/ex-debugbar.js',
                        ],
                    ],
                    'ex_debugbar_css' => [
                        'assets' => [
                            $debugBarRes . '/vendor/font-awesome/css/font-awesome.min.css',
                            $debugBarRes . '/vendor/highlightjs/styles/github.css',
                            $debugBarRes . '/debugbar.css',
                            $debugBarRes . '/widgets.css',
                            $debugBarRes . '/openhandler.css',
                            $debugBarRes . '/widgets/sqlqueries/widget.css',
                            getcwd() . '/vendor/bupy7/zf-php-debug-bar/assets/zf-snap-php-debug-bar.css',
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
