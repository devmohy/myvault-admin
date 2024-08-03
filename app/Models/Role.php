<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status',
        'business_id',
        'is_default'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission_mappings');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'like', '%' . $searchTerm . '%');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
