<?php

namespace App\DTO;

class VirtualAccountRequestDTO
{
  public function __construct(
    public $nameOnAccount,
  ) {
    $this->nameOnAccount = $nameOnAccount;
  }
}