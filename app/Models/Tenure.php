<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenure extends Model
{
    use HasFactory;
    protected $connection = 'vault';
    public function savings() {
        return $this->hasMany(Savings::class);
    }


    public function groupSavings() {
        return $this->hasMany(GroupSavings::class);
    }
}
