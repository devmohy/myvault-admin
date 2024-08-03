<?php

namespace App\Http\Controllers\Auth;

use App\Enum\UserStatusEnum;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends Controller
{
    public function verify(Request $request) {
        $user = User::findOrFail($request->id);
        if (! hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
            return response()->json([
                "message" => "Unauthorized",
                "success" => false
            ]);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                "message" => "User already verified!",
                "success" => false
            ], 400);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            $user->update([
                'status' => UserStatusEnum::ACTIVE
            ]);
        }

        dispatch(new SendWelcomeEmailJob($user));

        return response()->json([
            "message" => "Email verified successfully!",
            "success" => true
        ]);
    }

    public function resend(Request $request) {
        $user = User::where('email', $request->email)->whereNotNull('business_id')->first();

        if (!$user) {
            return response()->json([
                "message" => "Failed to send!",
                "success" => false
            ]);
        }
        $user->sendEmailVerificationNotification();
        return response()->json([
            "message" => "Check your email!",
            "success" => true
        ]);
    }
}