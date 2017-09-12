<?php

namespace ExAssetic\Command;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use AsseticBundle\Cli\SetupCommand;

class SetupCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): SetupCommand
    {
        $cmd = new SetupCommand($container->get('AsseticService'));
        return $cmd->setName('assetic:setup');
    }
}
