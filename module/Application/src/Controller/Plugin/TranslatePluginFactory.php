<?php

namespace Application\Controller\Plugin;
 
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TranslatePluginFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $translatePlg = new TranslatePlugin($container->get('translator'));
        return $translatePlg;
    }
}
