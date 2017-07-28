<?php

/**
 * The list of modules application.
 */

$modules = [
    'Zend\ServiceManager\Di',
    'Zend\Router',
    'Zend\I18n',
    'Zend\Mvc\I18n',
    'Zend\Navigation',
    'Zend\Mvc\Plugin\FlashMessenger',
    'Zend\Mvc\Console',
    'ExValidate',
    'DoctrineModule',
    'DoctrineORMModule',
    'DoctrineFixturesModule',
    'ExDoctrine',
    'AsseticBundle',
    'ExAssetic',
    'ZfcTwig',
    'ExTwig',
    'Bupy7\Form',
    'Bupy7\Mailgun',
    'Mail',
    'ZfcRbac',
    'ExRbac',
    'Application',
    'User',
];
if (APP_ENV_DEV) {
    $modules = array_merge($modules, [
        'ZfSnapPhpDebugBar',
        'ExDebugBar',
    ]);
}
return $modules;
