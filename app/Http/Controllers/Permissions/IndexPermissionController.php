<?php

namespace App\Http\Controllers\Permissions;

use App\Enum\UserTypeEnum;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexPermissionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if(auth()->user()->business_id){
            $permissions =Permission::where('user_type', UserTypeEnum::BUSINESS)->get();
        }else{
            $permissions =Permission::where('user_type', UserTypeEnum::ADMIN)->get();
        }
        return $permissions->groupBy('module');
    }
}
