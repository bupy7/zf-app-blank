<?php

namespace DataProvider;

return [
    'service_manager' => [
        'factories' => [
            QueryDataProvider::class => \Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
        ],
        'shared' => [
            QueryDataProvider::class => false,
        ],
    ],
];
