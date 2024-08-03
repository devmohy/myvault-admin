<?php

namespace App\Http\Controllers\Team;

use Throwable;
use App\Models\User;
use App\Models\AuditTrail;
use App\Models\UserInvite;
use App\Enum\EventTypeEnum;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\TeamInviteRequest;

class ResendInviteController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        DB::beginTransaction();
        try {
            $invite = UserInvite::where('email', $request->email)->first();
            $user = User::where('email', $request->email)->first();
           
            $newInvite = UserInvite::create([
                'email' => $user->email,
                'role_id' => $user->role_id,
                'business_id' => $user->business_id,
                'status' => 'pending',
            ]);
            if($invite){
                $invite->delete();
            }
            $user->sendInvite($newInvite);
       
            // Audit trail log
            $description = "Resent invite team member email - $request->email";
            logAuditTrail(EventTypeEnum::INVITE_TEAM_MEMBER, $description);
                
            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            logger(['error' => $e->getMessage()]);
            return response()->json([
                'message' => "Unable to resend invite to team member please try again",
            ], 500);
        }

        return $this->sendResponse($newInvite, "Team invite resent successfully");
    }
}
