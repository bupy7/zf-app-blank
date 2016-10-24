<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Bupy7\Form\FormAbstract;
use Zend\Authentication\AuthenticationServiceInterface;

class AuthController extends AbstractActionController
{
    /**
     * Route name to home.
     */
    const ROUTE_TO_HOME = 'home';
    /**
     * Route name to signin.
     */
    const ROUTE_TO_SIGNIN = 'signin';
    
    /**
     * @var FormAbstract
     */
    protected $signInForm;
    /**
     * @var AuthenticationServiceInterface
     */
    protected $authService;

    /**
     * @param AuthenticationServiceInterface $authService
     * @param Form $signInForm
     */
    public function __construct(AuthenticationServiceInterface $authService, FormAbstract $signInForm)
    {
        $this->authService = $authService;
        $this->signInForm = $signInForm;
    }

    /**
     * Signin user.
     * @return mixed
     */
    public function signinAction()
    {
        if ($this->authService->getIdentity()) {
            return $this->redirect()->toRoute(self::ROUTE_TO_HOME);
        }
        $signInForm = $this->signInForm;
        if ($this->getRequest()->isPost()) {
            $signInForm->setValues($this->getRequest()->getPost());
            if ($signInForm->isValid()) {
                $values = $signInForm->getValues();
                $auth = $this->authService;
                $auth
                    ->getAdapter()
                    ->setIdentity($values['email'])
                    ->setCredential($values['password']);
                $result = $auth->authenticate();
                if ($result->isValid()) {
                    $this->flashMessenger()
                        ->addSuccessMessage($this->translate('SUCCESS_SIGNIN', 'User'));
                    return $this->redirect()->toRoute(self::ROUTE_TO_HOME);
                }
            }
            $this->flashMessenger()
                ->addErrorMessage($this->translate('FAILED_SIGNIN', 'User'));
        }
        return new ViewModel([
            'signInForm' => $signInForm,
        ]);
    }

    /**
     * Logout user.
     * @return mixed
     */
    public function logoutAction()
    {
        $this->authService->clearIdentity();
        return $this->redirect()->toRoute(self::ROUTE_TO_SIGNIN);
    }
}
