<?php

namespace User;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return array_merge(
            require __DIR__ . '/../config/module.config.php',
            require __DIR__ . '/../config/router.config.php',
            require __DIR__ . '/../config/doctrine.config.php',
            require __DIR__ . '/../config/rbac.config.php',
            require __DIR__ . '/../config/navigation.config.php',
            require __DIR__ . '/../config/assets.config.php'
        );
    }
}
