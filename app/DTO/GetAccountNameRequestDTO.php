<?php

namespace App\DTO;

class GetAccountNameRequestDTO
{
  public function __construct(
    public $bankCode,
    public $accountNumber,
  ) {
    $this->bankCode = $bankCode;
    $this->accountNumber = $accountNumber;
  }
}