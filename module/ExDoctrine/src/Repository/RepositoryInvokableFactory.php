<?php

namespace ExDoctrine\Repository;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Fetch repository thought EntityManager.
 */
class RepositoryInvokableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): EntityRepository
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $container->get('Doctrine\ORM\EntityManager');
        $entityName = preg_replace(['/\\\\Repository/', '/Repository$/'], ['\\Entity', ''], $requestedName);
        return $em->getRepository($entityName);
    }
}
