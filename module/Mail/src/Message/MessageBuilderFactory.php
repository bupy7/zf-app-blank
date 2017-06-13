<?php

namespace Mail\Message;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class MessageBuilderFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new MessageBuilder($container->get('translator'), $container->get('ZfcTwigRenderer'));
    }
}
