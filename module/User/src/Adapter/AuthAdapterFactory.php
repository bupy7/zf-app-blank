<?php

namespace User\Adapter;

use DoctrineModule\Authentication\Adapter\ObjectRepository;
use DoctrineModule\Service\AbstractFactory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthAdapterFactory extends AbstractFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): AuthAdapter
    {
        $options = $this->getOptions($container, 'authentication');
        if (is_string($objectManager = $options->getObjectManager())) {
            $options->setObjectManager($container->get($objectManager));
        }
        return new AuthAdapter($options);
    }

    public function createService(ServiceLocatorInterface $serviceLocator): AuthAdapter
    {
        return $this($serviceLocator, ObjectRepository::class);
    }

    public function getOptionsClass(): string
    {
        return 'DoctrineModule\Options\Authentication';
    }
}
