<?php

namespace App\Http\Controllers\Roles;

use App\Enum\EventTypeEnum;
use App\Models\Role;
use App\Enum\RoleStatusEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Models\AuditTrail;

class CreateRoleController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => RoleStatusEnum::ACTIVE,
            'business_id' => $request->user()->business_id
        ]);
        $role->permissions()->attach($request->permissions);
        AuditTrail::create([
            'user_id' => $request->user()->id,
            'event_type' => EventTypeEnum::CREATE_ROLE,
            'business_id' => $request->user()->business_id,
            'description' => "Created role with name - $request->name",
        ]);
        return $this->sendResponse($role, "Role created successfully");
    }
}
