<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $connection = 'vault';
    protected $casts = [
        'accept_installments' => 'boolean',
    ];

    protected $guarded =['id'];

    protected $appends = ['image_url', 'slots_available'];

    public function getImageUrlAttribute()
    {   
            return $this->image_path !== null ? asset('storage/'.$this->image_path) : '';
    }

    public function getSlotsAvailableAttribute()
    {   
            return ($this->total_slots - optional($this->investments)->sum('slots') ?? 0);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
