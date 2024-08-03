<?php
namespace App\Enum;

enum BusinessStatusEnum:string{
  case PENDING = 'pending';
  case ACTIVE = 'active';
  case INACTIVE = 'inactive';
  case UNVERIFIED = 'unverified';
  case BLACKLISTED = 'blacklisted';
}