<?php

namespace Cli;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;

class Module implements ConfigProviderInterface, InitProviderInterface
{
    public function getConfig(): array
    {
        return require __DIR__ . '/../config/module.config.php';
    }

    public function init(ModuleManagerInterface $manager)
    {
        $event = $manager->getEvent();
        $container = $event->getParam('ServiceManager');
        /** @var \Zend\ModuleManager\Listener\ServiceListener $serviceListener */
        $serviceListener = $container->get('ServiceListener');
        $serviceListener->addServiceManager(
            'CommandManager',
            'command_manager',
            'Cli\Manager\Provider\CommandManagerProviderInterface',
            'getCommandManagerConfig'
        );
    }
}
