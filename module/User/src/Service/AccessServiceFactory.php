<?php

namespace User\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AccessServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): AccessService
    {
        return new AccessService(
            $container->get('Mail\Service\MailService'),
            $container->get('Doctrine\ORM\EntityManager')->getRepository('User\Entity\User'),
            $container->get('User\Crypt\PasswordCrypt')
        );
    }
}
