<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymyrentMortgageSavings extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = 'vault';

    public function savings() {
        return $this->belongsTo(Savings::class);
    }
}
