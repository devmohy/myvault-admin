<?php

namespace App\Http\Controllers\Team;

use App\Enum\UserStatusEnum;
use App\Models\User;
use App\Models\UserInvite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;

class AcceptInviteController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $inviteRef)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z-]+$/'],
            'last_name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z-]+$/'],
            'password' => ['required', 'string','max:150'],
        ]);
        
        $invite = UserInvite::where('id', $inviteRef)->first();

        if (!$invite) {
            return $this->sendError("Invite not found", 404);
        }

        if ($invite->isExpired()) {
            return $this->sendError("Invite has expired", 400);
        }

        if ($invite->isAccepted()) {
            return $this->sendError("Invite has already been accepted", 400);
        }
        
        $user = User::find($invite->user_id);
        if(!$user){
            return $this->sendError("Invite not found", 404);
        }
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
            'status' => UserStatusEnum::ACTIVE
        ]);
        $invite->markAsAccepted();
        return $this->sendResponse($user, "Invite accepted successfully");
    }
}
