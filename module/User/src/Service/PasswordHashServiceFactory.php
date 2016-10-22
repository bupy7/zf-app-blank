<?php

namespace User\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Crypt\Password\BcryptSha;

/**
 * Create hash service for passwords.
 * @see BcryptSha
 */
class PasswordHashServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new BcryptSha;
    }
}