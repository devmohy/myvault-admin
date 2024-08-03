<?php
namespace App\Enum;

enum TransactionStatus:string{
  case PENDING = 'pending';
  case SUCCESSFUL = 'successful';
  case FAILED = 'failed';
  case CANCELLED = 'cancelled';
  case REVERSED = 'reversed';
}