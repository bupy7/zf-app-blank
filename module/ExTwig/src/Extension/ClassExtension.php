<?php

namespace ExTwig\Extension;

use Twig_Extension;
use Twig_SimpleFunction;
use Twig_SimpleTest;

class ClassExtension extends Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'extwig-class-extension';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            'get_class' => new Twig_SimpleFunction('get_class', [$this, 'getClassName']),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getTests()
    {
        return [
            'instanceof' => new Twig_SimpleTest('instanceof', [$this, 'isInstanceOf']),
        ];
    }

    /**
     * @param object $object
     * @return string
     */
    public function getClassName($object)
    {
        return get_class($object);
    }

    /**
     * @param object|string $actualClass
     * @param object|string $expectClass
     * @return boolean
     */
    public function isInstanceOf($actualClass, $expectClass)
    {
        return $actualClass instanceof $expectClass;
    }
}