<?php

namespace ExAssetic\Cache;

use Assetic\Factory\Worker\WorkerInterface;
use AsseticBundle\CacheBuster\LastModifiedStrategy;
use AsseticBundle\CacheBuster\NoCache;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CacheBusterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): WorkerInterface
    {
        if (APP_DEBUG) {
            return new LastModifiedStrategy();
        }
        return new NoCache();
    }
}
