<?php

/**
 * Rbac configuration of file of this module and basic config `ZfcRbac` module.
 */

use ZfcRbac\Guard\GuardInterface;
use ZfcRbac\Guard\RoutePermissionsGuard;
use ZfcRbac\Role\InMemoryRoleProvider;

return [
    'zfc_rbac' => [
        /**
         * Key that is used to fetch the identity provider
         *
         * Please note that when an identity is found, it MUST implements the ZfcRbac\Identity\IdentityProviderInterface
         * interface, otherwise it will throw an exception.
         */
        // 'identity_provider' => 'ZfcRbac\Identity\AuthenticationIdentityProvider',

        /**
         * Set the guest role
         *
         * This role is used by the authorization service when the authentication service returns no identity
         */
        'guest_role' => 'guest',
        /**
         * Set the guards
         *
         * You must comply with the various options of guards. The format must be of the following format:
         *
         *      'guards' => [
         *          'ZfcRbac\Guard\RouteGuard' => [
         *              // options
         *          ]
         *      ]
         */
        'guards' => [
            RoutePermissionsGuard::class => [
                'home' => ['home'],
            ],
        ],
        /**
         * As soon as one rule for either route or controller is specified, a guard will be automatically
         * created and will start to hook into the MVC loop.
         *
         * If the protection policy is set to DENY, then any route/controller will be denied by
         * default UNLESS it is explicitly added as a rule. On the other hand, if it is set to ALLOW, then
         * not specified route/controller will be implicitly approved.
         *
         * DENY is the most secure way, but it is more work for the developer
         */
        'protection_policy' => GuardInterface::POLICY_DENY,
        /**
         * Configuration for role provider
         *
         * It must be an array that contains configuration for the role provider. The provider config
         * must follow the following format:
         *
         *      'ZfcRbac\Role\InMemoryRoleProvider' => [
         *          'role1' => [
         *              'children'    => ['children1', 'children2'], // OPTIONAL
         *              'permissions' => ['edit', 'read'] // OPTIONAL
         *          ]
         *      ]
         *
         * Supported options depend of the role provider, so please refer to the official documentation
         */
        'role_provider' => [
            InMemoryRoleProvider::class => [
                'registered' => [
                    'children' => ['guest'],
                    'permissions' => [
                        'home',
                    ],
                ],
                'guest' => [],
            ],
        ],
        /**
         * Configure the unauthorized strategy. It is used to render a template whenever a user is unauthorized
         */
        'unauthorized_strategy' => [
        /**
         * Set the template name to render
         */
        //'template' => 'error/403'
        ],
        /**
         * Configure the redirect strategy. It is used to redirect the user to another route when a user is
         * unauthorized
         */
        'redirect_strategy' => [
            /**
             * Enable redirection when the user is connected
             */
            'redirect_when_connected' => true,
            /**
             * Set the route to redirect when user is connected (of course, it must exist!)
             */
            'redirect_to_route_connected' => 'home',
            /**
             * Set the route to redirect when user is disconnected (of course, it must exist!)
             */
            'redirect_to_route_disconnected' => 'signin',
            /**
             * If a user is unauthorized and redirected to another route (login, for instance), should we
             * append the previous URI (the one that was unauthorized) in the query params?
             */
            'append_previous_uri' => false,
            /**
             * If append_previous_uri option is set to true, this option set the query key to use when
             * the previous uri is appended
             */
            'previous_uri_query_key' => 'redirectTo'
        ],
    /**
     * Various plugin managers for guards and role providers. Each of them must follow a common
     * plugin manager config format, and can be used to create your custom objects
     */
    // 'guard_manager'               => [],
    // 'role_provider_manager'       => []
    ]
];
