<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use HasUlids;
    use SoftDeletes;

    protected $guarded = [];
    protected $connection = 'vault';

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function savings()
    {
        return $this->belongsTo(Savings::class, 'trx_group_id');
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('narration', 'like', '%' . $searchTerm . '%')->orWhereHas('user', function ($q) use ($searchTerm) {
            $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $searchTerm . '%']);
        });
    }
    
}
