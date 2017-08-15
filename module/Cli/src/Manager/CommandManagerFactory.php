<?php

namespace Cli\Manager;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CommandManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): CommandManager
    {
        return new CommandManager($container, $options ?: []);
    }
}
