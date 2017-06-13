<?php

namespace Mail\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class MailServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): MailService
    {
        $options = $container->get('Mail\Options\ModuleOptions');
        return new MailService(
            $container->get('Bupy7\Mailgun\Service\MailgunService'),
            $options->getDomain(),
            $options->getSupportEmail(),
            $container->get('Mail\Message\MessageBuilder')
        );
    }
}
