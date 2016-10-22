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
                'assetic*' => ['assetic'],
            ],
        ],
        'role_provider' => [
            InMemoryRoleProvider::class => [
                'guest' => [
                    'permissions' => [
                        'assetic',
                    ],
                ],
            ],
        ],
    ],
];
