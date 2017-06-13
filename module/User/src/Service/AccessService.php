<?php

namespace User\Service;

use User\Form\ForgotPassForm;
use User\Form\RestorePassForm;
use Mail\Service\MailService;
use User\Repository\UserRepository;
use Zend\Math\Rand;
use DateTime;
use DateInterval;
use User\Entity\User;
use Zend\Crypt\Password\PasswordInterface;

class AccessService
{
    public const RESTORE_KEY_LENGTH = 18;
    public const RESTORE_KEY_DICT = 'abcdefghijklmnopqrstuvwxyz0123456789-_@$^';
    public const RESTORE_KEY_DURATION = 900; // in seconds

    /**
     * @var MailService
     */
    protected $mailService;
    /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var PasswordInterface
     */
    protected $passwordHashService;
    
    public function __construct(
        MailService $mailService,
        UserRepository $userRepository,
        PasswordInterface $passwordHashService
    ) {
        $this->mailService = $mailService;
        $this->userRepository = $userRepository;
        $this->passwordHashService = $passwordHashService;
    }

    public function forgotPass(array $data, ForgotPassForm $form): bool
    {
        $form->setValues($data);
        if (!$form->isValid()) {
            return false;
        }
        $entity = $this->userRepository->findOneByEmail($form->email);
        if (!$entity) {
            return false;
        }
        // generate restore key
        $restoreKeyExpire = new DateTime;
        $restoreKeyExpire->add(new DateInterval(sprintf('PT%dS', self::RESTORE_KEY_DURATION)));
        $entity->setRestoreKey(Rand::getString(self::RESTORE_KEY_LENGTH, self::RESTORE_KEY_DICT))
            ->setRestoreKeyExpire($restoreKeyExpire);
        $this->userRepository->persist($entity);
        $this->userRepository->flush();
        // send email
        $message = $this->mailService->createMessageBuilder();
        $message->addToRecipient($entity->getEmail(), ['full_name' => $entity->getPerson()]);
        $message->setTranslateSubject('EMAIL_SUBJECT_RESTORE_PASS', 'User');
        $message->setRenderHtmlBody('user/mail/restore-pass', ['userEntity' => $entity]);
        $this->mailService->send($message);
        return true;
    }

    public function findForRestore(string $email, string $key): ?User
    {
        $entity = $this->userRepository->findForRestore($email, $key);
        if (!$entity || $entity->getRestoreKeyExpire() < new DateTime) {
            return null;
        }
        return $entity;
    }

    public function restorePass(array $data, User $entity, RestorePassForm $form): bool
    {
        $form->setValues($data);
        if (!$form->isValid()) {
            return false;
        }
        $hashPassword = $this->passwordHashService->create($form->password);
        $entity->setPassword($hashPassword)
            ->setRestoreKeyExpire(new DateTime);
        $this->userRepository->persist($entity);
        $this->userRepository->flush();
        return true;
    }
}
