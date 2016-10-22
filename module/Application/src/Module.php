<?php

namespace Application;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Base application module.
 */
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
            require __DIR__ . '/../config/assets.config.php',
            require __DIR__ . '/../config/rbac.config.php',
            require __DIR__ . '/../config/navigation.config.php',
            require __DIR__ . '/../config/doctrine.config.php',
            require __DIR__ . '/../config/rbac.config.php',
            require __DIR__ . '/../config/twig.config.php'
        );
    }
}