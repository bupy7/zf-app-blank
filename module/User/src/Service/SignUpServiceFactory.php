<?php

namespace User\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SignUpServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $userRepository = $container->get('Doctrine\ORM\EntityManager')->getRepository('User\Entity\User');
        $passwordHashService = $container->get('User\Service\PasswordHashService');
        return new SignUpService($userRepository, $passwordHashService);
    }
}
