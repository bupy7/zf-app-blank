<?php

namespace DataProvider;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig(): array
    {
        return require __DIR__ . '/../config/module.config.php';
    }
}
