<?php
namespace App\Enum;

enum TransactionGroup:string{
  case AIRTIME = 'airtime';
  case INVESTMENT = 'investment';
  case SAVINGS = 'savings';
  case WALLET = 'walLet';
  case WITHDRAWAL = 'withdrawal';
}