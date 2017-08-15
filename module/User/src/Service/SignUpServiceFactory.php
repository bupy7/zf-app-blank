<?php

namespace User\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SignUpServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): SignUpService
    {
        $userRepository = $container->get('Doctrine\ORM\EntityManager')->getRepository('User\Entity\User');
        $passwordHashService = $container->get('User\Crypt\PasswordCrypt');
        return new SignUpService($userRepository, $passwordHashService);
    }
}
