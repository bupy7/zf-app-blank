<?php

namespace Cli\Manager;

use Zend\ServiceManager\AbstractPluginManager;
use Symfony\Component\Console\Command\Command;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\SharedEventManagerInterface;
use Interop\Container\ContainerInterface;

class CommandManager extends AbstractPluginManager
{
    protected $instanceOf = Command::class;

    public function __construct($configOrContainerInstance, array $config = [])
    {
        $this->addInitializer([$this, 'injectEventManager']);
        parent::__construct($configOrContainerInstance, $config);
    }

    public function injectEventManager(ContainerInterface $container, Command $command)
    {
        if (!$command instanceof EventManagerAwareInterface) {
            return;
        }
        $events = $command->getEventManager();
        if (!$events || !$events->getSharedManager() instanceof SharedEventManagerInterface) {
            $command->setEventManager($container->get('EventManager'));
        }
    }
}
