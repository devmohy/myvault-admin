<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupSavings extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $connection = 'vault';

    protected $appends = ['image_url'];


    public function getImageUrlAttribute()
    {   
            return $this->image !== null ? asset('storage/'.$this->image) : '';
    }

    public function savings() {
        return $this->hasMany(Savings::class);
    }

    public function tenure() {
        return $this->belongsTo(Tenure::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }



}
