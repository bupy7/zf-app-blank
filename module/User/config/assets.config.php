<?php

/**
 * Assets configuration file for User module.
 */

return [
    'assetic_configuration' => [
        'routes' => [
            'signin' => [
                '@auth_js',
            ],
            'signup' => [
                '@signup_js',
            ],
        ],
        'modules' => [
            'User' => [
                'root_path' => __DIR__ . '/../assets',
                'collections' => [
                    'signup_js' => [
                        'assets' => [
                            'js/models/signup.js',
                            'js/views/signup.js',
                            'js/routers/signup.js',
                        ],
                        'filters' => [
                            '?UglifyJs2Filter',
                        ],
                        'options' => [
                            'output' => 'js/signup.min.js',
                        ],
                    ],
                    'auth_js' => [
                        'assets' => [
                            'js/models/signin.js',
                            'js/views/signin.js',
                            'js/routers/auth.js',
                        ],
                        'filters' => [
                            '?JsCompressorFilter',
                        ],
                        'options' => [
                            'output' => 'js/auth.min.js',
                        ],
                    ],
                ],
            ],
        ],
    ],
];