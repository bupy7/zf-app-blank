<?php

namespace Application;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig(): array
    {
        return array_merge(
            require __DIR__ . '/../config/module.config.php',
            require __DIR__ . '/../config/router.config.php',
            require __DIR__ . '/../config/assets.config.php',
            require __DIR__ . '/../config/rbac.config.php',
            require __DIR__ . '/../config/navigation.config.php',
            require __DIR__ . '/../config/doctrine.config.php',
            require __DIR__ . '/../config/rbac.config.php',
            require __DIR__ . '/../config/twig.config.php'
        );
    }
}
