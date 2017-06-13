<?php

namespace User\Service;

use Mail\Service\MailService;
use User\Entity\User;
use User\Repository\UserRepository;
use User\Form\AgainConfirmForm;

class ConfirmEmailService
{
    /**
     * @var MailService
     */
    protected $mailService;
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(
        MailService $mailService,
        UserRepository $userRepository
    ) {
        $this->mailService = $mailService;
        $this->userRepository = $userRepository;
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
        $this->userRepository->persist($user);
        $this->userRepository->flush();
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
