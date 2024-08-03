<?php
namespace App\Enum;

enum EventTypeEnum:string{
  case ADD_EMPLOYEE = 'Added employee';
  case DELETE_EMPLOYEE = 'Deleted employee';
  case ACTIVATE_EMPLOYEE = 'Activated employee';
  case DEACTIVATE_EMPLOYEE = 'Deactivated employee';
  case CREATE_ROLE = 'Created role';
  case UPDATE_ROLE = 'Updated role';
  case UPDATE_ROLE_STATUS = 'Updated role status';
  case INVITE_TEAM_MEMBER = 'Invited team member';
  case UPDATE_TEAM_MEMBER_STATUS = 'Updated team member status';
  case UPDATE_TEAM_MEMBER = 'Updated team member';
  case CREATE_KYB_SETTING = 'Created a KYB setting';
  case UPDATE_KYB_SETTING = 'Updated KYB setting';
  case DELETE_KYB_SETTING = 'Deleted KYB setting';
  case ACTIVATE_BUSINESS = 'Activated business';
  case DEACTIVATE_BUSINESS = 'Deactivated business';
  case BLACKLIST_BUSINESS = 'Blacklisted business';
  case CREATE_PAYROLL = 'Created payroll';
  case APPROVE_PAYROLL = 'Approved payroll';
  case DECLINE_PAYROLL = 'Declined payroll';
  case DELETE_EMPLOYEE_FROM_PAYROLL = 'Deleted employee from payroll';
  case UPDATE_EMPLOYEE_PAYROLL = 'Updated employee of a payroll';
}