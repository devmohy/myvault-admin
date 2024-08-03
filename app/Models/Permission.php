<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['module', 'action', 'description', 'user_type'];

    // Define the relationship with roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission_mappings');
    }
}
