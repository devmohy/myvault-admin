<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Bank extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'bank_name',
        'bank_code',
        'bank_nip_code',
    ] ;

    public function bankDetail()
    {
        return $this->hasMany(BankDetails::class);
    }

    public function virtualAccountDetail()
    {
        return $this->hasMany(VirtualAccountDetails::class);
    }
    
}
