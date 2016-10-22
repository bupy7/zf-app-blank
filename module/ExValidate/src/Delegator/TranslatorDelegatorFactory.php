<?php

namespace ExValidate\Delegator;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

/**
 * Setting custom messages for `Zend\Validator` validators.
 */
class TranslatorDelegatorFactory implements DelegatorFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        $translator = $callback();
        $translator->addTranslationFilePattern('phparray', __DIR__ . '/../../language', '%s.php', 'ExValidate');
        return $translator;
    }
}
