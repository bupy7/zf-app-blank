<?php

namespace ExAssetic\Filter\Yui;

use Interop\Container\ContainerInterface;
use Assetic\Filter\Yui\CssCompressorFilter;
use Zend\ServiceManager\Factory\FactoryInterface;

class CssCompressorFilterFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $container->get('ExAssetic\Options\ModuleOptions');
        return new CssCompressorFilter($options->yuiPath, $options->javaPath);
    }
}
