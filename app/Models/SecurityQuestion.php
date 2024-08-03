<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityQuestion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = 'vault';

    public function userSecurityQuestion() {
        return $this->hasMany(UserSecurityQuestion::class);
    }
}
