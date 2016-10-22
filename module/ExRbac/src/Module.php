<?php

namespace ExRbac;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Http\Request as HttpRequest;

/**
 * The module expands functional of `ZfcRbac`.
 */
class Module implements BootstrapListenerInterface
{
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        $app = $e->getApplication();
        $services = $app->getServiceManager();

        // redirect to 403 Forbidden
        if ($e->getRequest() instanceof HttpRequest) {
            $services->get('ZfcRbac\View\Strategy\RedirectStrategy')->attach($app->getEventManager());
        }
    }
}