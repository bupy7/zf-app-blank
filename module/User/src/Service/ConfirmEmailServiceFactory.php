<?php

namespace User\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ConfirmEmailServiceFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): ConfirmEmailService {
        return new ConfirmEmailService(
            $container->get('Mail\Service\MailService'),
            $container->get('Doctrine\ORM\EntityManager')->getRepository('User\Entity\User')
        );
    }
}
