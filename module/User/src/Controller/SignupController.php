<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Bupy7\Form\FormAbstract;
use Zend\Authentication\AuthenticationServiceInterface;
use User\Entity\UserInterface;
use Zend\Hydrator\HydratorInterface;
use User\Service\SignUpServiceInterface;

class SignupController extends AbstractActionController
{
    /**
     * Route name to home.
     */
    const ROUTE_TO_HOME = 'home';

    /**
     * @var FormAbstract
     */
    protected $signUpForm;
    /**
     * @var AuthenticationServiceInterface
     */
    protected $authService;
    /**
     * @var UserInterface
     */
    protected $userEntity;
    /**
     * @var HydratorInterface
     */
    protected $entityHydrator;
    /**
     * @var SignUpServiceInterface
     */
    protected $signUpService;

    /**
     * @param AuthenticationServiceInterface $authService
     * @param Form $signUpForm
     * @param UserInterface $userEntity
     * @param HydratorInterface $entityHydrator
     * @param SignUpServiceInterface $signUpService
     */
    public function __construct(
        AuthenticationServiceInterface $authService,
        FormAbstract $signUpForm,
        UserInterface $userEntity,
        HydratorInterface $entityHydrator,
        SignUpServiceInterface $signUpService
    ) {
        $this->authService = $authService;
        $this->signUpForm = $signUpForm;
        $this->userEntity = $userEntity;
        $this->entityHydrator = $entityHydrator;
        $this->signUpService = $signUpService;
    }

    /**
     * Sign up a new user.
     * @return mixed
     */
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
                    return $this->redirect()->toRoute(self::ROUTE_TO_HOME);
                }
            }
        }
        return new ViewModel([
            'signUpForm' => $signUpForm,
        ]);
    }

    /**
     * Validate an Email for sign up.
     * @return mixed
     */
    public function emailValidAction()
    {
        $email = $this->getRequest()->getQuery('email');
        $errors = [];
        if ($email) {
            $signUpForm = $this->signUpForm;
            $signUpForm->setValues(['email' => $email]);
            if (!$signUpForm->getInputFilter()->setValidationGroup('email')->isValid()) {
                $errors = $signUpForm->getErrors();
            }
        }
        return new JsonModel([
            'errors' => $errors,
        ]);
    }
}
