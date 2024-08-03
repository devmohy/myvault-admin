<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualAccount extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = 'vault';

    public function wallet() {
        return $this->hasOne(WalletBalance::class);
    }
}
