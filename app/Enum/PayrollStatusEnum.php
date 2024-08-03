<?php
namespace App\Enum;

enum PayrollStatusEnum:string{
  case PENDING = 'pending';
  case DISBURSED = 'disbursed';
  case APPROVED = 'Approved';
  case DECLINED = 'decline';
  case DELETED = 'deleted';
}