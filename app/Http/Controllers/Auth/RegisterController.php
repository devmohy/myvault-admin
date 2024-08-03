<?php

namespace App\Http\Controllers\Auth;

use App\Enum\BusinessStatusEnum;
use Throwable;
use App\Models\Role;
use App\Models\User;
use App\Models\Business;
use App\Models\Permission;
use App\Enum\RoleStatusEnum;
use App\Enum\UserStatusEnum;
use App\Enum\UserTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Influencer register.
     * 
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $attributes = $request->validated();
        $this->validateBusinessName($request);
        $attributes['password'] = Hash::make($attributes['password']);
        DB::beginTransaction();
        try {
            $business = Business::create([
                'business_name' => $request->business_name,
                'rc_number' => $request->rc_number,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'business_type' => $request->business_type,
                'status' => BusinessStatusEnum::PENDING,
            ]);
            $permissions = Permission::where('user_type', UserTypeEnum::BUSINESS)->get();
            $role = Role::create([
                'name' => 'Business Owner',
                'description' => 'Has access to full permissions',
                'status' => RoleStatusEnum::ACTIVE,
                'business_id' => $business->id,
                'is_default' => true,
            ]);
            $role->permissions()->attach($permissions);
            $attributes['role_id'] = $role->id;
            $attributes['business_id'] = $business->id;
            $attributes['status'] = UserStatusEnum::PENDING;

            $user = User::create($attributes);
            $business->update(['owner_id' => $user->id]);
            $user->sendEmailVerificationNotification();
            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            logger(['error' => $e->getMessage()]);
            return response()->json([
                'message' => "Business Registration failed please try again",
            ], 500);
        }

        return response()->json([
            'message' => "Business Registration successful",
            'user' => $user,
        ]);
    }

    public function validateBusinessName(Request  $request)
    {
        $request->validate([
            'business_name' => ['required', 'string', 'max:200', 'unique:businesses,business_name'],
        ]);
        $userWithBusinessNameAlreadyExists = Business::where("business_name", $request->business_name)
            ->first();
        if ($userWithBusinessNameAlreadyExists) {
            throw ValidationException::withMessages([
                'business_name' => ['Business already exists'],
            ]);
        } else {
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function validateEmail(Request  $request)
    {
        $request->validate(['email' => ['required', 'email:rfc,dns', 'max:200','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/']]);
        $userEmailExists = User::where("email", $request->email)->whereNotNull("business_id")
            ->first();
        if ($userEmailExists) {
            throw ValidationException::withMessages([
                'email' => ['Email already exists'],
            ]);
        } else {
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function validateRcNumber(Request  $request)
    {
        $request->validate([
            'rc_number' => ['required', 'string', 'max:10', 'unique:businesses,rc_number'],
        ]);
        $userWithBusinessNameAlreadyExists = Business::where("rc_number", $request->rc_number)
            ->first();
        if ($userWithBusinessNameAlreadyExists) {
            throw ValidationException::withMessages([
                'rc_number' => ['Business Indentification Number already exists'],
            ]);
        } else {
            return response()->json([
                'success' => true,
            ]);
        }
    }
}
