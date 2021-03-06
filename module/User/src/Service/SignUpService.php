<?php

namespace User\Service;

use Doctrine\ORM\EntityManager;
use User\Entity\User;
use Zend\Crypt\Password\PasswordInterface;
use User\Repository\UserRepository;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\Math\Rand;
use DateTime;

class SignUpService implements EventManagerAwareInterface
{
    public const DEFAULT_ROLE = User::ROLE_REGISTERED;
    public const LENGTH_CONFIRM_KEY = 18;
    public const CONFIRM_KEY_DICT = 'abcdefghijklmnopqrstuvwxyz0123456789-_@$^';
    
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var PasswordInterface
     */
    private $passwordHashService;
    /**
     * @var EventManagerInterface
     */
    private $eventManager;
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->setIdentifiers([__CLASS__, get_called_class()]);
        $this->eventManager = $eventManager;
        return $this;
    }

    public function getEventManager(): EventManagerInterface
    {
        if ($this->eventManager === null) {
            $this->setEventManager(new EventManager());
        }
        return $this->eventManager;
    }

    public function __construct(
        UserRepository $userRepository,
        PasswordInterface $passwordHashService,
        EntityManager $entityManager
    ) {
        $this->userRepository = $userRepository;
        $this->passwordHashService = $passwordHashService;
        $this->entityManager = $entityManager;
    }

    public function signup(User $userEntity): bool
    {
        if ($userEntity->getRoleId() === null) {
            $userEntity->setRoleId(self::DEFAULT_ROLE);
        }
        $hashPassword = $this->passwordHashService->create($userEntity->getPassword());
        $userEntity->setPassword($hashPassword)
            ->setConfirmKey(Rand::getString(self::LENGTH_CONFIRM_KEY, self::CONFIRM_KEY_DICT))
            ->setCreatedAt(new DateTime);

        $this->entityManager->persist($userEntity);
        $this->entityManager->flush();

        if ($userEntity->getId() === null) {
            return false;
        }
        $this->getEventManager()->trigger(__FUNCTION__, $this, ['userEntity' => $userEntity]);

        return true;
    }

    public function confirmEmail(User $userEntity): bool
    {
        $userEntity->setEmailConfirm(true);

        $this->entityManager->persist($userEntity);
        $this->entityManager->flush();

        return true;
    }
}
