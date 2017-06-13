<?php

namespace User\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ConfirmEmailControllerFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): ConfirmEmailController {
        return new ConfirmEmailController(
            $container->get('User\Service\ConfirmEmailService'),
            $container->get('Doctrine\ORM\EntityManager')->getRepository('User\Entity\User')
        );
    }
}
