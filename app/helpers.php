<?php

use App\Models\AuditTrail;

if (!function_exists('logAuditTrail')) {
  function logAuditTrail($event_type, string $description)
  {
    AuditTrail::create([
      'user_id' => auth()->user()->id,
      'event_type' => $event_type,
      'business_id' => auth()->user()->business_id,
      'description' => $description
    ]);
  }
}
