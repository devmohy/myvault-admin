<?php

namespace App\DTO;

class TransferFundsRequestDTO
{
  public function __construct(
    public $sourceBankCode,
    public $sourceAccountNumber,
    public $destinationBankCode,
    public $destinationAccountNumber,
    public $amount,
    public $reference,
  ) {
    $this->sourceBankCode = $sourceBankCode;
    $this->sourceAccountNumber = $sourceAccountNumber;
    $this->destinationBankCode = $destinationBankCode;
    $this->destinationAccountNumber = $destinationAccountNumber;
    $this->amount = $amount;
    $this->reference = $reference;
  }
}