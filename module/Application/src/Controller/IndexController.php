<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * Main page.
     * @return mixed
     */
    public function indexAction()
    {
        return new ViewModel();
    }
}