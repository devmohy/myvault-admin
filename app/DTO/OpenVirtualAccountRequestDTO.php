<?php

namespace App\DTO;

class OpenVirtualAccountRequestDTO
{
  public function __construct(
    public $nameOnAccount,
    public $firstName,
    public $lastName,
    public $email,
    public $phoneNumber,
  ) {
    $this->nameOnAccount = $nameOnAccount;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->phoneNumber = $phoneNumber;
  }
}