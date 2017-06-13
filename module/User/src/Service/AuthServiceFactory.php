<?php

namespace User\Service;

use Zend\Authentication\AuthenticationServiceInterface;
use Interop\Container\ContainerInterface;
use User\Entity\User;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * @see https://github.com/doctrine/DoctrineModule/blob/master/docs/authentication.md
 */
class AuthServiceFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): AuthenticationServiceInterface {
        $authService = $container->get('doctrine.authenticationservice.orm_default');
        $passHashService = $container->get('Di')->get('Zend\Crypt\Password\BcryptSha');
        $authService
            ->getAdapter()
            ->getOptions()
            ->setCredentialCallable(function (User $user, $password) use ($passHashService) {
                return $passHashService->verify($password, $user->getPassword());
            });
        return $authService;
    }
}
