<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Notifications\Auth\ResetPasswordNotification;

class AuthController extends Controller
{
    /**
     * Otp service.
     * 
     * @var \App\Services\OtpService
     */
    protected $otpService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    /**
     * Customer login.
     * 
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $user = User::with('role', 'business', 'business.virtualAccount')->where('email', $request->email)->first();
        if (!$user->password) {
            return response()->json([
                'message' => "Please accept invite first",
            ], 401);
        }

        if ($user->status !== 'active') {
            return response()->json([
                'message' => "Account is $user->status",
            ], 401);
        }

        if ($user->role->status !== 'active') {
            return response()->json([
                'message' => "Account Role is $user->status",
            ], 401);
        }

        if ($user->business && ($user->business->status == 'inactive' || $user->business->status == 'blacklisted')) {
            return response()->json([
                'message' => "Business is {$user->business->status}",
            ], 401);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
        try {
            DB::table('personal_access_tokens')
            ->where('tokenable_id', $user->id)
            ->delete();
            $user->update(['last_active' =>now()]);
            $userType = $user->business_id ? 'business' : 'admin';
            $permissions = $user->role->permissions->pluck('action')->unique()->values()->all();
            $token = $user->createToken($user->email, ["is-$userType",...$permissions]);
            $user->type = $userType;
        } catch (Throwable $e) {
            DB::rollback();
            logger(['Login Error' => $e->getMessage()]);
            return response()->json([
                'message' => "Login failed please try again",
            ], 500);
        }

        return response()->json([
            'message' => "Login successful",
            'token' => $token->plainTextToken,
            'user' => new UserResource($user)
        ]);
    }

    /**
     * Forgot Customer password.
     * 
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgot(ForgotPasswordRequest $request){
        $user = User::where('email', $request->email)->first();
        $user->notify(new ResetPasswordNotification($user));
        return response()->json([
            'message' => "Password reset link has been sent to " . $user->email,
        ]);
    }

    /**
     * Reset Customer password.
     * 
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(ResetPasswordRequest $request){
        $user = User::where('email', $request->email)->first();
        $validateToken = DB::table('password_reset')->where('email', $user->email)->first();
        if (!$validateToken) {
            return response()->json([
                'message' => 'Invalid token provided'
            ], 401);
        }
        $user->update([
            'password' => bcrypt($request->password),
        ]);
        return response()->json([
            'message' => "Password reset successful",
        ]);
    }

    
    /**
     * Logout Customer.
     * 
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => "User logout successfully"
        ]);
    }

}
