<?php

namespace Core\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Helper to return locale code of the application.
 */
class LocaleHelper extends AbstractHelper
{
    /**
     * @var string
     */
    protected $_locale;

    /**
     * @param string $locale
     */
    public function __construct($locale)
    {
        $this->_locale = $locale;
    }

    /**
     * @return string
     */
    public function __invoke()
    {
        return $this->_locale;
    }
}
