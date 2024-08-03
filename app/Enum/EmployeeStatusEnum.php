<?php
namespace App\Enum;

enum EmployeeStatusEnum:string{
  case PENDING = 'pending';
  case ACTIVE = 'active';
  case INACTIVE = 'inactive';
  case DELETED = 'deleted';
}