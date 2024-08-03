<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSecurityQuestion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = 'vault';

    protected $with = ["question:id,name"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(SecurityQuestion::class, 'id');
    }
}
