<?php

/**
 * Rbac configuration of file of this module.
 */

use ZfcRbac\Guard\RoutePermissionsGuard;
use ZfcRbac\Role\InMemoryRoleProvider;

return [
    'zfc_rbac' => [
        'guards' => [
            RoutePermissionsGuard::class => [
                'signin' => ['user/auth/signin'],
                'logout' => ['user/auth/logout'],
                'signup' => ['user/signup/signup'],
                'signup-email-valid' => ['user/signup/email-valid'],
            ],
        ],
        'role_provider' => [
            InMemoryRoleProvider::class => [
                'guest' => [
                    'permissions' => [
                        'user/auth/signin',
                        'user/auth/logout',
                        'user/signup/signup',
                        'user/signup/email-valid',
                    ],
                ],
            ],
        ],
    ],
];

