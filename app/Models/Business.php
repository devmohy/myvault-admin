<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory;
    use HasUlids;
    protected $guarded = ['id'];
    protected $cast = [
        'enable_sms' => 'boolean',
        'enable_email' => 'boolean'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function bankDetails(): HasOne
    {
        return $this->hasOne(BankDetails::class);
    }
    
    public function payslipSettings(): HasOne
    {
        return $this->hasOne(PayslipSetting::class);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('business_name', 'like', '%' . $searchTerm . '%')->orWhereHas('owner', function ($q) use ($searchTerm) {
            $q->where('email', 'like', '%' . $searchTerm . '%');
            $q->orWhere('phone_number', 'like', '%' . $searchTerm . '%');
            $q->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $searchTerm . '%');
            $q->orWhere(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', '%' . $searchTerm . '%');
        });
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get the virtual account associated with the business.
     */
    public function virtualAccount(): HasOne
    {
        return $this->hasOne(BusinessVirtualAccount::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
