<?php

namespace App\DTO;

class BookLoanRequestDTO
{
  public function __construct(
    public $phoneNumber,
    public $email,
    public $amount,
  ) {
    $this->phoneNumber = $phoneNumber;
    $this->email = $email;
    $this->amount = $amount;
  }
}
