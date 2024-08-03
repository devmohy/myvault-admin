<?php
namespace App\Enum;

enum PaymentType:string{
  case INTEREST = 'interest';
  case AIRTIME = 'airtime';
  case INVESTMENT = 'investment';
  case SAVINGS = 'savings';
  case WALLET = 'walLet';
  case CARD = 'card';
}