<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = 'vault';

    public function balances() {
        return $this->hasMany(WalletBalance::class);
    }
}
