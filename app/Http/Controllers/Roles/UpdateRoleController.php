<?php

namespace App\Http\Controllers\Roles;

use App\Models\Role;
use App\Models\AuditTrail;
use App\Enum\EventTypeEnum;
use App\Enum\RoleStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class UpdateRoleController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $role = Role::find($id);
    
        if (!$role) {
            return $this->sendError("Role not found", 404);
        }
        $businessId = $request->user()->business_id;
        $request->validate([
            'name' => [
                'required',
                Rule::unique('roles')->ignore($role->id)->where(function ($query) use ($businessId) {
                    return $query->where('business_id', $businessId);
                }),
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', 'exists:permissions,id']
        ]);
    
        $role->permissions()->sync($request->permissions);
        $role->update([
            'name' => $request->name ?? $role->name,
            'description' => $request->description ?? $role->description,
            'business_id' => $request->user()->business_id
        ]);
    
        AuditTrail::create([
            'user_id' => $request->user()->id,
            'event_type' => EventTypeEnum::UPDATE_ROLE,
            'business_id' => auth()->user()->business_id,
            'description' => "Updated role with name - " . ($request->name ?? $role->name),
        ]);
    
        return $this->sendResponse($role, "Role updated successfully");
    }
}
