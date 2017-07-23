<?php

use ZfcRbac\Guard\RoutePermissionsGuard;
use ZfcRbac\Role\InMemoryRoleProvider;

return [
    'zfc_rbac' => [
        'guards' => [
            RoutePermissionsGuard::class => [
                'signin' => ['user/auth/signin'],
                'logout' => ['user/auth/logout'],
                'signup' => ['user/signup/signup'],
                'confirm-email' => ['user/confirm-email/confirm'],
                'confirm-again' => ['user/confirm-again/again'],
                'forgot-pass' => ['user/access/forgot-pass'],
                'restore-pass' => ['user/access/restore-pass'],
            ],
        ],
        'role_provider' => [
            InMemoryRoleProvider::class => [
                'guest' => [
                    'permissions' => [
                        'user/auth/signin',
                        'user/auth/logout',
                        'user/signup/signup',
                        'user/confirm-email/confirm',
                        'user/confirm-again/again',
                        'user/access/forgot-pass',
                        'user/access/restore-pass',
                    ],
                ],
            ],
        ],
    ],
];
