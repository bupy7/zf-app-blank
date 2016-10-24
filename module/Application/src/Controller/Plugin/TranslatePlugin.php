<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\I18n\Translator\TranslatorInterface;

class TranslatePlugin extends AbstractPlugin
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;
    /**
     * @var string
     */
    protected $translatorTextDomain;
 
    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
 
    /**
     * Translate a message.
     *
     * @param string $message
     * @param string $textDomain
     * @param string $locale
     * @return string
     */
    public function __invoke($message, $textDomain = null, $locale = null)
    {
        if ($textDomain === null) {
            $textDomain = $this->translatorTextDomain;
        }
        return $this->translator->translate($message, $textDomain, $locale);
    }
    
    /**
     * @param string $textDomain
     */
    public function setTranslatorTextDomain($textDomain)
    {
        $this->translatorTextDomain = $textDomain;
    }
}
