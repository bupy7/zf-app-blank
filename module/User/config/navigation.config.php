<?php

/**
 * Configuration file for navigation of this module.
 */

return [
    'navigation' => [
        'guestright' => [
            [
                'label' => 'MENU_SIGNIN',
                'route' => 'signin',
                'icon' => 'fa fa-sign-in',
                'text_domain' => 'User',
            ],
            [
                'label' => 'MENU_SIGNUP',
                'route' => 'signup',
                'icon' => 'fa fa-user-plus',
                'text_domain' => 'User',
            ],
        ],
        'authright' => [
            [
                'label' => 'MENU_LOGOUT',
                'route' => 'logout',
                'icon' => 'fa fa-sign-out',
                'text_domain' => 'User',
            ],
        ],
    ],
];
