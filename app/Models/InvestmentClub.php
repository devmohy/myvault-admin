<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentClub extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $connection = 'vault';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
