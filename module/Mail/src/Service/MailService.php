<?php

namespace Mail\Service;

use Mail\Message\MessageBuilder;
use Mailgun\Mailgun;
use Mailgun\Model\ApiResponse;

class MailService
{
    /**
     * @var Mailgun
     */
    protected $client;
    /**
     * @var string
     */
    protected $supportEmail;
    /**
     * @var string
     */
    protected $domain;
    /**
     * @var MessageBuilder
     */
    protected $messageBuilder;

    public function __construct(Mailgun $client, string $domain, string $supportEmail, MessageBuilder $messageBuilder)
    {
        $this->client = $client;
        $this->supportEmail = $supportEmail;
        $this->domain = $domain;
        $this->messageBuilder = $messageBuilder;
    }

    public function send(MessageBuilder $message): ApiResponse
    {
        $message->setFromAddress($this->supportEmail);
        return $this->client->messages()->send($this->domain, $message->getMessage());
    }

    public function createMessageBuilder(): MessageBuilder
    {
        return clone $this->messageBuilder;
    }
}
