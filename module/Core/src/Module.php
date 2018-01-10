<?php

namespace Core;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

class Module implements ConfigProviderInterface, BootstrapListenerInterface
{
    private const ERROR_LOG_FILE = __DIR__ . '/../logs/errors.log';

    public function getConfig(): array
    {
        return array_merge(
            require __DIR__ . '/../config/module.config.php',
            require __DIR__ . '/../config/router.config.php',
            require __DIR__ . '/../config/assets.config.php',
            require __DIR__ . '/../config/rbac.config.php',
            require __DIR__ . '/../config/navigation.config.php',
            require __DIR__ . '/../config/doctrine.config.php',
            require __DIR__ . '/../config/rbac.config.php',
            require __DIR__ . '/../config/twig.config.php'
        );
    }

    public function onBootstrap(EventInterface $e)
    {
        /** @var \Zend\Mvc\MvcEvent $e */
        $sharedManager = $e->getApplication()->getEventManager()->getSharedManager();
        $logger = $this->getLogger();
        $sharedManager->attach('Zend\Mvc\Application', 'dispatch.error', function ($e) use ($logger) {
            if ($e->getParam('exception')) {
                $logger->crit($e->getParam('exception'));
            }
        });
        Logger::registerFatalErrorShutdownFunction($logger);
    }

    protected function getLogger(): Logger
    {
        $logger = new Logger;
        $writer = new Stream(self::ERROR_LOG_FILE);
        return $logger->addWriter($writer);
    }
}
