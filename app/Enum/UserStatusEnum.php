<?php
namespace App\Enum;

enum UserStatusEnum:string{
  case PENDING = 'pending';
  case ACTIVE = 'active';
}