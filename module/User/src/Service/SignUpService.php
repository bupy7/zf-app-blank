<?php

namespace User\Service;

use User\Entity\UserInterface;
use Zend\Crypt\Password\PasswordInterface;
use User\Repository\UserRepositoryInterface;

class SignUpService implements SignUpServiceInterface
{
    /**
     * Role a new user by default.
     */
    const DEFAULT_ROLE = UserInterface::ROLE_REGISTERED;
    
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;
    /**
     * @var PasswordInterface
     */
    protected $passwordHashService;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param PasswordInterface $passwordHashService
     */
    public function __construct(UserRepositoryInterface $userRepository, PasswordInterface $passwordHashService)
    {
        $this->userRepository = $userRepository;
        $this->passwordHashService = $passwordHashService;
    }

    /**
     * {@inheritDoc}
     */
    public function signup(UserInterface $userEntity)
    {
        if ($userEntity->getRole() === null) {
            $userEntity->setRole(self::DEFAULT_ROLE);
        }
        $hashPassword = $this->passwordHashService->create($userEntity->getPassword());
        $userEntity->setPassword($hashPassword);
        $this->userRepository->persist($userEntity);
        $this->userRepository->flush();
        return $userEntity->getId() !== null;
    }
}
