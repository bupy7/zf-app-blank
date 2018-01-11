<?php

namespace User\Controller;

use User\Form\ForgotPassForm;
use User\Form\RestorePassForm;
use User\Service\AccessService;
use Core\Controller\ActionControllerAbstract;
use Zend\View\Model\ViewModel;

class AccessController extends ActionControllerAbstract
{
    private const ROUTE_TO_SIGNIN = 'signin';
    
    /**
     * @var AccessService
     */
    private $accessService;

    public function __construct(AccessService $accessService)
    {
        $this->accessService = $accessService;
    }
    
    public function forgotPassAction()
    {
        $form = new ForgotPassForm;
        if ($this->getRequest()->isPost()) {
            if ($this->accessService->forgotPass($this->getRequest()->getPost()->toArray(), $form)) {
                $this->flashMessenger()->addSuccessMessage($this->translate('SUCCESS_SENT_RESTORE_KEY', 'User'));
                return $this->redirect()->refresh();
            } else {
                $this->flashMessenger()->addWarningMessage($this->translate('FAILED_SEND_RESTORE_KEY', 'User'));
            }
        }
        return new ViewModel(['forgotPassForm' => $form]);
    }

    public function restorePassAction()
    {
        $email = $this->params()->fromRoute('e');
        $key = $this->params()->fromRoute('k');
        $entity = $this->accessService->findForRestore($email, $key);
        if (!$entity) {
            $this->flashMessenger()->addWarningMessage($this->translate('FAILED_RESTORE_PASS', 'User'));
            return $this->redirect()->toRoute(self::ROUTE_TO_SIGNIN);
        }
        $form = new RestorePassForm;
        if ($this->getRequest()->isPost()) {
            if ($this->accessService->restorePass($this->getRequest()->getPost()->toArray(), $entity, $form)) {
                $this->flashMessenger()->addSuccessMessage($this->translate('SUCCESS_RESTORE_PASS', 'User'));
                return $this->redirect()->toRoute(self::ROUTE_TO_SIGNIN);
            }
        }
        return new ViewModel([
            'restorePassForm' => $form,
            'email' => $email,
            'key' => $key,
        ]);
    }
}
