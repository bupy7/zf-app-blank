<?php

namespace Mail;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return require __DIR__ . '/../config/module.config.php';
    }
}
