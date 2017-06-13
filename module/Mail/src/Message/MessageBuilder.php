<?php

namespace Mail\Message;

use Mailgun\Messages\MessageBuilder as BaseMessageBuilder;
use Zend\I18n\Translator\TranslatorInterface;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\RendererInterface;

class MessageBuilder extends BaseMessageBuilder
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;
    /**
     * @var RendererInterface
     */
    protected $viewRenderer;

    public function __construct(TranslatorInterface $translator, RendererInterface $viewRenderer)
    {
        $this->translator = $translator;
        $this->viewRenderer = $viewRenderer;
    }

    public function setRenderHtmlBody(string $template, array $variables): string
    {
        $viewModel = new ViewModel($variables);
        $viewModel->setTemplate($template);
        return parent::setHtmlBody($this->viewRenderer->render($viewModel));
    }

    public function setTranslateSubject(string $message, string $domain): string
    {
        return parent::setSubject($this->translator->translate($message, $domain));
    }
}
