<?php

namespace App\Http\Controllers\Team;

use Throwable;
use App\Models\User;
use App\Models\UserInvite;
use App\Enum\EventTypeEnum;
use App\Enum\UserStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendTeamInviteEmailJob;
use App\Notifications\TeamInvitation;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Team\TeamInviteRequest;

class InviteTeamController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TeamInviteRequest $request)
    {
        DB::beginTransaction();
        try {
            $invite = UserInvite::create([
                'email' => $request->email,
                'role_id' => $request->role_id,
                'business_id' => $request->user()->business_id,
                'status' => 'pending',
            ]);
            $user = User::create([
                'email' => $invite->email,
                'business_id' => $invite->business_id,
                'status' => UserStatusEnum::PENDING,
                'role_id' => $invite->role_id,
            ]);
            $invite->update([
                'user_id' => $user->id,
            ]);
            $user->notify(new TeamInvitation($user, $invite));
            // Audit trail log
            $description = "Invited team member email - $request->email";
            logAuditTrail(EventTypeEnum::INVITE_TEAM_MEMBER, $description);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            logger(['error' => $e->getMessage()]);
            return response()->json([
                'message' => "Unable to invite team member please try again",
            ], 500);
        }

        return $this->sendResponse($invite, "Team Invite sent successfully");
    }
}
