<?php

namespace User;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;

class Module implements ConfigProviderInterface, BootstrapListenerInterface
{
    public function getConfig(): array
    {
        return array_merge(
            require __DIR__ . '/../config/module.config.php',
            require __DIR__ . '/../config/router.config.php',
            require __DIR__ . '/../config/doctrine.config.php',
            require __DIR__ . '/../config/rbac.config.php',
            require __DIR__ . '/../config/navigation.config.php'
        );
    }

    public function onBootstrap(EventInterface $e)
    {
        $sm = $e->getApplication()->getServiceManager();

        // confirm email request
        $confirmEmailService = $sm->get('User\Service\ConfirmEmailService');
        $signUpEventManager = $sm->get('User\Service\SignUpService')->getEventManager();
        $signUpEventManager->attach('signup', function (EventInterface $event) use ($confirmEmailService) {
            $confirmEmailService->request($event->getParam('userEntity'));
        });
    }
}
