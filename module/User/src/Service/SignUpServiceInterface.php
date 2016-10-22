<?php

namespace User\Service;

use User\Entity\UserInterface;

interface SignUpServiceInterface
{
    /**
     * @param UserInterface $userEntity
     */
    public function signup(UserInterface $userEntity);
}
