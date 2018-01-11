<?php

namespace ExAssetic\Filter\Sass;

use Interop\Container\ContainerInterface;
use Assetic\Filter\Sass\SassFilter;
use Zend\ServiceManager\Factory\FactoryInterface;

class SassFilterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): SassFilter
    {
        $options = $container->get('ExAssetic\Options\ModuleOptions');
        return new SassFilter($options->sassPath);
    }
}
