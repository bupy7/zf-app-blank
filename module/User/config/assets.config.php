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
            'confirm-again' => [
                '@confirm_again_js'
            ],
            'forgot-pass' => [
                '@access_js',
            ],
            'restore-pass' => [
                '@access_js',
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
                            '?UglifyJs2Filter',
                        ],
                        'options' => [
                            'output' => 'js/auth.min.js',
                        ],
                    ],
                    'confirm_again_js' => [
                        'assets' => [
                            'js/models/confirm-again.js',
                            'js/views/confirm-again.js',
                            'js/routers/confirm-email.js',
                        ],
                        'filters' => [
                            '?UglifyJs2Filter',
                        ],
                        'options' => [
                            'output' => 'js/confirm-again.min.js',
                        ],
                    ],
                    'access_js' => [
                        'assets' => [
                            'js/models/forgot-pass.js',
                            'js/models/restore-pass.js',
                            'js/views/forgot-pass.js',
                            'js/views/restore-pass.js',
                            'js/routers/access.js',
                        ],
                        'filters' => [
                            '?UglifyJs2Filter',
                        ],
                        'options' => [
                            'output' => 'js/access.min.js',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
