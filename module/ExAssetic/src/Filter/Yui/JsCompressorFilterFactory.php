<?php

namespace ExAssetic\Filter\Yui;

use Interop\Container\ContainerInterface;
use Assetic\Filter\Yui\JsCompressorFilter;
use Zend\ServiceManager\Factory\FactoryInterface;

class JsCompressorFilterFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $container->get('ExAssetic\Options\ModuleOptions');
        return new JsCompressorFilter($options->yuiPath, $options->javaPath);
    }
}
