<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupSavingsInvite extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = 'vault';
}
