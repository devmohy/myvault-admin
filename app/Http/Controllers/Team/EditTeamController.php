<?php

namespace App\Http\Controllers\Team;

use App\Models\User;
use App\Models\AuditTrail;
use App\Enum\EventTypeEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Team\TeamUpdateRequest;

class EditTeamController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TeamUpdateRequest $request,$id)
    {
        $user = User::find($id);

        if(!$user){
            return $this->sendError("Team member not found", 404);
        }
        
        $user->update([
            'email' => $request->email ?? $user->email,
            'role_id' => $request->role_id ?? $user->role_id
        ]);

        // Audit trail log
        $description = "Updated team with email - $request->email";
        logAuditTrail(EventTypeEnum::UPDATE_TEAM_MEMBER, $description);

        return $this->sendResponse($user, "Team member updated successfully");
    }
}
