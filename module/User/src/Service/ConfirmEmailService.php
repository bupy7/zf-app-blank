<?php

namespace User\Service;

use Doctrine\ORM\EntityManager;
use Mail\Service\MailService;
use User\Entity\User;
use User\Repository\UserRepository;
use User\Form\AgainConfirmForm;

class ConfirmEmailService
{
    /**
     * @var MailService
     */
    private $mailService;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(
        MailService $mailService,
        UserRepository $userRepository,
        EntityManager $entityManager
    ) {
        $this->mailService = $mailService;
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    public function request(User $user): bool
    {
        $message = $this->mailService->createMessageBuilder();
        $message->addToRecipient($user->getEmail(), [
            'full_name' => $user->getPerson(),
        ]);
        $message->setTranslateSubject('EMAIL_SUBJECT_CONFIRM_EMAIL', 'User');
        $message->setRenderHtmlBody('user/mail/confirm-request', ['userEntity' => $user]);
        $this->mailService->send($message);
        return true;
    }

    public function confirm(User $user): bool
    {
        $user->setEmailConfirm(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }

    public function again(array $data, AgainConfirmForm $form): bool
    {
        $form->setValues($data);
        if (!$form->isValid()) {
            return false;
        }

        $user = $this->userRepository->findOneByEmail($form->email);
        if ($user === null || $user->getEmailConfirm()) {
            return false;
        }

        return $this->request($user);
    }
}
