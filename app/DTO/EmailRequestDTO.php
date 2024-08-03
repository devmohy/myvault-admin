<?php

namespace App\DTO;

class EmailRequestDTO
{
  public function __construct(
    public $emailType,
    public $messageSubject,
    public $messageBody,
    public EmailRecipientDTO $recipient,
    public ?string $redirectLinkTitle,
    public ?string $redirectLink
  ) {
    $this->emailType = $emailType;
    $this->messageSubject = $messageSubject;
    $this->messageBody = $messageBody;
    $this->recipient = $recipient;
    $this ->redirectLinkTitle = $redirectLinkTitle;
    $this->redirectLink = $redirectLink;
  }
}
