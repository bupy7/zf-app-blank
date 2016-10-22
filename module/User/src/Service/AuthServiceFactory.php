<?php

namespace User\Service;

use Interop\Container\ContainerInterface;
use User\Entity\UserInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * @see https://github.com/doctrine/DoctrineModule/blob/master/docs/authentication.md
 */
class AuthServiceFactory implements FactoryInterface
{    
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authService = $container->get('doctrine.authenticationservice.orm_default');
        $passHashService = $container->get('User\Service\PasswordHashService');
        $authService
            ->getAdapter()
            ->getOptions()
            ->setCredentialCallable(function(UserInterface $user, $password) use ($passHashService) {
                return $passHashService->verify($password, $user->getPassword());
            });
        return $authService;
    }
}

