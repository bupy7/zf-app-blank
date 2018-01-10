<?php

namespace Core\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController as BaseActionControllerAbstract;

/**
 * @method \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger flashMessenger()
 * @method \Zend\Http\PhpEnvironment\Request getRequest()
 * @method \Zend\Http\PhpEnvironment\Response getResponse()
 * @method \Core\Controller\Plugin\TranslatePlugin translate()
 */
abstract class ActionControllerAbstract extends BaseActionControllerAbstract
{
    public function asJson(array $data = [], int $code = 200): JsonModel
    {
        $this->getResponse()->setStatusCode($code);
        return new JsonModel($data);
    }

    public function asView(array $data = [], array $options = []): ViewModel
    {
        return new ViewModel(!empty($data) ? $data : null, !empty($options) ? $options : null);
    }
}
