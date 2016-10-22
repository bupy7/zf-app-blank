<?php

namespace ExDebugBar\Delegator;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\DBAL\Logging\DebugStack;

class DoctrineConfigurationDelegatorFactory implements DelegatorFactoryInterface
{
    /**
    * {@inheritDoc}
    */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        $doctrineConfiguration = $callback();
        $doctrineConfiguration->setSQLLogger(new DebugStack);
        return $doctrineConfiguration;
    }

    /**
     * {@inheritDoc}
     */
    public function createDelegatorWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName, $callback)
    {
        return $this($serviceLocator, $requestedName, $callback);
    }
}
