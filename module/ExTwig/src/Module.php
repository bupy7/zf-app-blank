<?php

namespace ExTwig;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * The module expands functional of `ZfcTwig`.
 */
class Module implements ConfigProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return require __DIR__ . '/../config/module.config.php';
    }
}
