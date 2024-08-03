<?php

namespace App\Http\Controllers\Roles;

use App\Enum\EventTypeEnum;
use App\Http\Controllers\BaseController;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AuditTrail;

class UpdateRoleStatusController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $role = Role::find($id);

        if(!$role){
            return $this->sendError("Role not found", 404);
        }
        
        $role->update([
            'status' => $request->status,
        ]);
        $message = $request->status == 'active' ? "$role->name activated successfully" : "$role->name deactivated successfully";

        AuditTrail::create([
            'user_id' => $request->user()->id,
            'event_type' => EventTypeEnum::UPDATE_ROLE_STATUS,
            'business_id' => auth()->user()->business_id,
            'description' => "Updated role status with name - $role->name",
        ]);

        return $this->sendResponse($role, $message);
    }
}
