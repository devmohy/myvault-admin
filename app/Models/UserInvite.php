<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInvite extends Model
{
    use HasFactory;
    use HasUlids;
    use SoftDeletes;
    protected $guarded = ['id'];


    /**
     * Check if the invite has expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->created_at->lt(now()->subSeconds(1800));
    }

    /**
     * Check if the invite has already been accepted.
     *
     * @return bool
     */
    public function isAccepted()
    {
        return !is_null($this->accepted_at);
    }

    /**
     * Mark the invite as accepted.
     */
    public function markAsAccepted()
    {
        $this->update([
                'accepted_at' => now(),
                'status' => 'accepted'
            ]);
    }

}
