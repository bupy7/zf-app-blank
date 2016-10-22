<?php

namespace User\Controller;

use Interop\Container\ContainerInterface;
use User\Form\SignInForm;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authService = $container->get('Zend\Authentication\AuthenticationService');
        return new AuthController($authService, new SignInForm);
    }
}