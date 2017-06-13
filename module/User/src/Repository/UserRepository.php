<?php

namespace User\Repository;

use ExDoctrine\Repository\RepositoryAbstract;
use User\Entity\User;

class UserRepository extends RepositoryAbstract
{
    public function findNotConfirm(string $email, string $confirmKey): ?User
    {
        $entity = $this->findOneBy(['email' => $email, 'confirmKey' => $confirmKey]);
        if ($entity === null || $entity->getEmailConfirm()) {
            return null;
        }
        return $entity;
    }

    public function findForRestore(string $email, string $restoreKey): ?User
    {
        return $this->findOneBy(['email' => $email, 'restoreKey' => $restoreKey]);
    }
}
