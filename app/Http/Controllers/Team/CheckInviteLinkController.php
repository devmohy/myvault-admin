<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\BaseController;
use App\Models\UserInvite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckInviteLinkController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $invite = UserInvite::where('id', $id)->first();

        if (!$invite) {
            return $this->sendError("Invite not found", 404);
        }

        if ($invite->isExpired()) {
            return $this->sendError("Invite has expired", 400);
        }

        if ($invite->isAccepted()) {
            return $this->sendError("Invite has already been accepted", 400);
        }

        return $this->sendResponse($invite, "Invite still valid");
    }
}
