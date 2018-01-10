<?php

namespace Core\View\Helper;

use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Zend\View\Helper\AbstractHelper;
use cebe\markdown\GithubMarkdown;

/**
 * Helper to return messages and flash messages.
 * Default all messages will be dismissable except for warnings and errors.
 */
class AlertMessageHelper extends AbstractHelper
{
    /**
     * Message Type constants
     */
    const MESSAGE_TYPE_DEFAULT = 'default';
    const MESSAGE_TYPE_SUCCESS = 'success';
    const MESSAGE_TYPE_INFO = 'info';
    const MESSAGE_TYPE_WARNING = 'warning';
    const MESSAGE_TYPE_ERROR = 'error';
    
    /**
     * @var FlashMessenger Holds a FlashMessenger instance
     */
    protected $flashMessenger = null;
    /**
     * @var array Holds the messages
     */
    protected static $flashMessages = [];
    /**
     * @var GithubMarkdown
     */
    protected $markdown;
    
    /**
     * Invoke Method
     * Returns all the messages in a html string in the view.
     * @return string
     */
    public function __invoke()
    {
        $this->setFlashMessenger();
        return $this->getFlashMessages();
    }
    
    /**
     * Constructor method.
     */
    public function __construct()
    {
        $this->setFlashMessenger();
        $this->markdown = new GithubMarkdown;
    }
    
    /**
     * Add a new message
     *
     * @param string $message
     * @param bool $dismissable
     */
    public function addMessage($message, $dismissable = true)
    {
        $this->addMessageByType(self::MESSAGE_TYPE_DEFAULT, $message, $dismissable);
    }
    
    /**
     * Add a new success message
     *
     * @param string $successMessage
     * @param bool $dismissable
     */
    public function addSuccessMessage($successMessage, $dismissable = true)
    {
        $this->addMessageByType(self::MESSAGE_TYPE_SUCCESS, $successMessage, $dismissable);
    }
    
    /**
     * Add a new info message
     *
     * @param string $infoMessage
     * @param bool $dismissable
     */
    public function addInfoMessage($infoMessage, $dismissable = true)
    {
        $this->addMessageByType(self::MESSAGE_TYPE_INFO, $infoMessage, $dismissable);
    }
    
    /**
     * Add a new warning message
     *
     * @param string $warningMessage
     * @param bool $dismissable
     */
    public function addWarningMessage($warningMessage, $dismissable = false)
    {
        $this->addMessageByType(self::MESSAGE_TYPE_WARNING, $warningMessage, $dismissable);
    }
    
    /**
     * Add a new error message
     *
     * @param string $errorMessage
     * @param bool $dismissable
     */
    public function addErrorMessage($errorMessage, $dismissable = false)
    {
        $this->addMessageByType(self::MESSAGE_TYPE_ERROR, $errorMessage, $dismissable);
    }

    /**
     * Set a instance of the FlashMessenger.
     */
    public function setFlashMessenger()
    {
        if ($this->flashMessenger === null) {
            $this->flashMessenger = new FlashMessenger;
        }
    }

    /**
     * Add a message by type
     *
     * @param string $type
     * @param string $message
     * @param bool $dismissable
     */
    protected function addMessageByType($type, $message, $dismissable = true)
    {
        self::$flashMessages[$type][] = [
            'message' => $this->markdown->parse($message),
            'dismissable' => $dismissable,
        ];
    }
    
    /**
     * Get all flash messages from the plugin
     */
    protected function getFlashMessages()
    {
        if ($this->flashMessenger->hasMessages()) {
            foreach ($this->flashMessenger->getMessages() as $message) {
                $this->addMessageByType(self::MESSAGE_TYPE_DEFAULT, $message);
            }
        }
        if ($this->flashMessenger->hasSuccessMessages()) {
            foreach ($this->flashMessenger->getSuccessMessages() as $successMessages) {
                $this->addMessageByType(self::MESSAGE_TYPE_SUCCESS, $successMessages);
            }
        }
        if ($this->flashMessenger->hasInfoMessages()) {
            foreach ($this->flashMessenger->getInfoMessages() as $infoMessages) {
                $this->addMessageByType(self::MESSAGE_TYPE_INFO, $infoMessages);
            }
        }
        if ($this->flashMessenger->hasWarningMessages()) {
            foreach ($this->flashMessenger->getWarningMessages() as $warningMessages) {
                $this->addMessageByType(self::MESSAGE_TYPE_WARNING, $warningMessages);
            }
        }
        if ($this->flashMessenger->hasErrorMessages()) {
            foreach ($this->flashMessenger->getErrorMessages() as $errorMessages) {
                $this->addMessageByType(self::MESSAGE_TYPE_ERROR, $errorMessages);
            }
        }
        return self::$flashMessages;
    }
}
