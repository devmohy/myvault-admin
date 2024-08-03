<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamMemberResource;

class SingleTeamController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $user = User::with('role')->find($id);
        if (!$user) {
            return $this->sendError("Team member not found", 404);
        }
        return $this->sendResponse($user, 'Team member fetched successfully',  200, function ($item) {
            return new TeamMemberResource($item);
        });
    }
}
