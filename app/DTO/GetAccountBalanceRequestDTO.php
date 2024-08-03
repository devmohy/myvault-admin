<?php

namespace App\DTO;

class GetAccountBalanceRequestDTO
{
  public function __construct(
    public $bankCode,
    public $accountNumber,
  ) {
    $this->bankCode = $bankCode;
    $this->accountNumber = $accountNumber;
  }
}