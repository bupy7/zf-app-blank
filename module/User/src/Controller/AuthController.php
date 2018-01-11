<?php

namespace User\Controller;

use Bupy7\Form\FormAbstract;
use User\Auth\Result;
use Zend\Authentication\AuthenticationServiceInterface;
use Core\Controller\ActionControllerAbstract;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;

class AuthController extends ActionControllerAbstract
{
    private const ROUTE_TO_HOME = 'home';
    private const ROUTE_TO_SIGNIN = 'signin';
    private const ROUTE_TO_CONFIRM_AGAIN = 'confirm-again';
    
    /**
     * @var FormAbstract
     */
    private $signInForm;
    /**
     * @var AuthenticationServiceInterface
     */
    private $authService;

    public function __construct(AuthenticationServiceInterface $authService, FormAbstract $signInForm)
    {
        $this->authService = $authService;
        $this->signInForm = $signInForm;
    }

    /**
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
                $auth = $this->authService;
                $auth->getAdapter()
                    ->setIdentity($signInForm->email)
                    ->setCredential($signInForm->password);
                $result = $auth->authenticate();
                if ($result->isValid()) {
                    $this->flashMessenger()->addSuccessMessage($this->translate('SUCCESS_SIGNIN', 'User'));
                    return $this->redirect()->toRoute(self::ROUTE_TO_HOME);
                } elseif ($result->getCode() == Result::FAILURE_DIDNT_CONFIRM) {
                    $message = $this->translate('FAILED_SIGNIN_DIDNT_CONFIRM', 'User');
                    $message = sprintf($message, $this->url()->fromRoute(self::ROUTE_TO_CONFIRM_AGAIN));
                    $this->flashMessenger()->addWarningMessage($message);
                    return $this->redirect()->toRoute(self::ROUTE_TO_HOME);
                }
            }
            $this->flashMessenger()->addErrorMessage($this->translate('FAILED_SIGNIN', 'User'));
        }
        return new ViewModel([
            'signInForm' => $signInForm,
        ]);
    }

    public function logoutAction(): Response
    {
        $this->authService->clearIdentity();
        return $this->redirect()->toRoute(self::ROUTE_TO_SIGNIN);
    }
}
