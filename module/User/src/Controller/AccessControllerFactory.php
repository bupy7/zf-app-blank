<?php

namespace User\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AccessControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): AccessController
    {
        return new AccessController($container->get('User\Service\AccessService'));
    }
}
