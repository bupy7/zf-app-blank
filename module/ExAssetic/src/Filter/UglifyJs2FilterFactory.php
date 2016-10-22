<?php

namespace ExAssetic\Filter;

use Interop\Container\ContainerInterface;
use Assetic\Filter\UglifyJs2Filter;
use Zend\ServiceManager\Factory\FactoryInterface;

class UglifyJs2FilterFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $container->get('ExAssetic\Options\ModuleOptions');
        return new UglifyJs2Filter($options->uglifyJs2Path, $options->nodeBin);
    }
}
