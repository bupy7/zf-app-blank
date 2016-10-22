<?php

namespace ExDebugBar\Collector;

use Interop\Container\ContainerInterface;
use DebugBar\Bridge\DoctrineCollector;
use Zend\ServiceManager\Factory\FactoryInterface;

class DoctrineCollectorFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $debugStack = $container->get('doctrine.configuration.orm_default')->getSQLLogger();
        return new DoctrineCollector($debugStack);
    }
}