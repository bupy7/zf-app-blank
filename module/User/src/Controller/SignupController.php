<?php

namespace User\Controller;

use Bupy7\Form\FormAbstract;
use User\Entity\User;
use User\Repository\UserRepository;
use User\Service\SignUpService;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Hydrator\HydratorInterface;
use Core\Controller\ActionControllerAbstract;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;

class SignupController extends ActionControllerAbstract
{
    private const ROUTE_TO_HOME = 'home';
    private const ROUTE_TO_SIGNIN = 'signin';

    /**
     * @var FormAbstract
     */
    private $signUpForm;
    /**
     * @var AuthenticationServiceInterface
     */
    private $authService;
    /**
     * @var User
     */
    private $userEntity;
    /**
     * @var HydratorInterface
     */
    private $entityHydrator;
    /**
     * @var SignUpService
     */
    private $signUpService;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        AuthenticationServiceInterface $authService,
        FormAbstract $signUpForm,
        User $userEntity,
        HydratorInterface $entityHydrator,
        SignUpService $signUpService,
        UserRepository $userRepository
    ) {
        $this->authService = $authService;
        $this->signUpForm = $signUpForm;
        $this->userEntity = $userEntity;
        $this->entityHydrator = $entityHydrator;
        $this->signUpService = $signUpService;
        $this->userRepository = $userRepository;
    }

    public function signupAction()
    {
        if ($this->authService->getIdentity()) {
            return $this->redirect()->toRoute(self::ROUTE_TO_HOME);
        }
        $signUpForm = $this->signUpForm;
        if ($this->getRequest()->isPost()) {
            $signUpForm->setValues($this->getRequest()->getPost());
            if ($signUpForm->isValid()) {
                $values = $signUpForm->getValues();
                $userEntity = $this->entityHydrator->hydrate($values, clone $this->userEntity);
                if ($this->signUpService->signup($userEntity)) {
                    $this->flashMessenger()
                        ->addSuccessMessage($this->translate('SUCCESS_SIGNUP', 'User'));
                    return $this->redirect()->toRoute(self::ROUTE_TO_SIGNIN);
                }
            }
        }
        return new ViewModel([
            'signUpForm' => $signUpForm,
        ]);
    }

    public function confirmEmailAction(): Response
    {
        $email = $this->params()->fromRoute('e');
        $key = $this->params()->fromRoute('k');
        $userEntity = $this->userRepository->findNotConfirm($email, $key);
        if ($userEntity === null) {
            $this->flashMessenger()
                ->addWarningMessage($this->translate('WARNING_CONFIRM_EMAIL_NOT_FOUND', 'User'));
        } else {
            if ($this->signUpService->confirmEmail($userEntity)) {
                $this->flashMessenger()
                    ->addSuccessMessage($this->translate('SUCCESS_CONFIRM_EMAIL', 'User'));
            }
        }
        return $this->redirect()->toRoute(self::ROUTE_TO_SIGNIN);
    }
}
