<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    use HasFactory;

    protected $connection = 'vault';

    protected $guarded = ['id'];

    protected $casts = [
        'request' => 'array',
        'response' => 'array',
    ];
}
