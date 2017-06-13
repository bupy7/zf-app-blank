<?php

namespace ExDoctrine;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Doctrine\DBAL\Types\Type;
use ExDoctrine\Type\DateTimeType;

class Module implements ConfigProviderInterface, BootstrapListenerInterface
{
    public function getConfig(): array
    {
        return array_merge(
            require __DIR__ . '/../config/module.config.php',
            require __DIR__ . '/../config/rbac.config.php'
        );
    }

    public function onBootstrap(EventInterface $e)
    {
        Type::overrideType('datetime', DateTimeType::class);
        Type::overrideType('datetimetz', DateTimeType::class);
    }
}
