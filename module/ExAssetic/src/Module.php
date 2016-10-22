<?php

namespace ExAssetic;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * The module expands functional of `AsseticBundle`.
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
            require __DIR__ . '/../config/rbac.config.php'
        );
    }
}
