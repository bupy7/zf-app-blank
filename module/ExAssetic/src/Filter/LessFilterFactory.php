<?php

namespace ExAssetic\Filter;

use Interop\Container\ContainerInterface;
use Assetic\Filter\LessFilter;
use Zend\ServiceManager\Factory\FactoryInterface;

class LessFilterFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $container->get('ExAssetic\Options\ModuleOptions');
        return new LessFilter($options->nodeBin, $options->nodePaths);
    }
}
