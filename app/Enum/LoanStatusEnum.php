<?php
namespace App\Enum;

enum LoanStatusEnum:string{
  case PENDING = 'pending';
  case AWAITING_DISBURSEMENT = 'awaiting disbursement';
  case APPROVED = 'approved';
  case REJECTED = 'rejected';
  case RUNINING = 'running';
  case PAID = 'paid';
}