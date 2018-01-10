<?php

namespace User\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SignUpServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): SignUpService
    {
        return new SignUpService(
            $container->get('User\Repository\UserRepository'),
            $container->get('User\Crypt\PasswordCrypt'),
            $container->get('Doctrine\ORM\EntityManager')
        );
    }
}
