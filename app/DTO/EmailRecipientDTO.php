<?php

namespace App\DTO;

class EmailRecipientDTO
{
  public function __construct(
    public $email,
    public $phoneNumber,
    public $name,
  ) {
    $this->email = $email;
    $this->phoneNumber = $phoneNumber;
    $this->name = $name;
  }
}
