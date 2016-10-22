<?php

namespace ExDoctrine\Repository;

use Doctrine\ORM\EntityRepository;

abstract class RepositoryAbstract extends EntityRepository implements RepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function persist($object)
    {
        $this->getEntityManager()->persist($object);
    }

    /**
     * {@inheritDoc}
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}

