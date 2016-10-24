<?php

namespace User\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SignupControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authService = $container->get('Zend\Authentication\AuthenticationService');
        $signUpForm = $container->get('User\Form\SignUpForm');
        $userEntityName = $container->get('Doctrine\ORM\EntityManager')
            ->getRepository('User\Entity\User')
            ->getClassName();
        $entityHydrator = $container->get('ExDoctrine\Hydrator\ObjectHydrator');
        $signUpService = $container->get('User\Service\SignUpService');
        return new SignupController($authService, $signUpForm, new $userEntityName, $entityHydrator, $signUpService);
    }
}
