<?php

namespace App\Http\Controllers\Team;

use App\Enum\EventTypeEnum;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\AuditTrail;

class UpdateTeamMemberStatusController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $user = User::find($id);

        if(!$user){
            return $this->sendError("User not found", 404);
        }
        
        $user->update([
            'status' => $request->status,
        ]);
        $message = $request->status == 'active' ? "$user->email activated successfully" : "$user->email Deactivated successfully";

        // Audit trail log
        $description = "Updated team member status with email - $user->email";
        logAuditTrail(EventTypeEnum::UPDATE_TEAM_MEMBER_STATUS, $description);

        return $this->sendResponse($user, $message);
    }
}
