<?php

namespace App\Http\Controllers\Roles;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Controllers\BaseController;

class SingleRoleController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $role = Role::with('permissions', 'users')->find($id);
        if (!$role) {
            return $this->sendError("Role not found", 404);
        }
        return $this->sendResponse($role, 'Role fetched successfully',  200, function ($item) {
            return new RoleResource($item);
        });
    }
}
