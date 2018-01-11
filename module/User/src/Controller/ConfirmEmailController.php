<?php

namespace User\Controller;

use User\Form\AgainConfirmForm;
use User\Repository\UserRepository;
use User\Service\ConfirmEmailService;
use Core\Controller\ActionControllerAbstract;
use Zend\View\Model\ViewModel;

class ConfirmEmailController extends ActionControllerAbstract
{
    private const ROUTE_TO_SIGNIN = 'signin';

    /**
     * @var ConfirmEmailService
     */
    private $confirmEmailService;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(ConfirmEmailService $confirmEmailService, UserRepository $userRepository)
    {
        $this->confirmEmailService = $confirmEmailService;
        $this->userRepository = $userRepository;
    }

    public function confirmAction()
    {
        $email = $this->params()->fromRoute('e');
        $key = $this->params()->fromRoute('k');
        $userEntity = $this->userRepository->findNotConfirm($email, $key);
        if ($userEntity === null) {
            $this->flashMessenger()
                ->addWarningMessage($this->translate('WARNING_CONFIRM_EMAIL_NOT_FOUND', 'User'));
        } else {
            if ($this->confirmEmailService->confirm($userEntity)) {
                $this->flashMessenger()
                    ->addSuccessMessage($this->translate('SUCCESS_CONFIRM_EMAIL', 'User'));
            }
        }
        return $this->redirect()->toRoute(self::ROUTE_TO_SIGNIN);
    }

    public function againAction()
    {
        $form = new AgainConfirmForm;
        if ($this->getRequest()->isPost()) {
            $result = $this->confirmEmailService->again($this->getRequest()->getPost()->toArray(), $form);
            if ($result) {
                $this->flashMessenger()->addSuccessMessage($this->translate('SUCCESS_SENT_CONFIRM_KEY_AGAIN', 'User'));
                return $this->redirect()->toRoute(self::ROUTE_TO_SIGNIN);
            } else {
                $this->flashMessenger()->addWarningMessage($this->translate('FAILED_SENT_CONFIRM_KEY_AGAIN', 'User'));
            }
        }
        return new ViewModel([
            'againForm' => $form,
        ]);
    }
}
