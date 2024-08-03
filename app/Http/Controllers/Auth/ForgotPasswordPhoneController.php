<?php

namespace App\Http\Controllers\Auth;

use App\Otp;
use App\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordPhoneController extends Controller
{

    public function forget(Request $request, OtpService $otp){
        $request->validate(['phone_number' => 'required|digits:11|exists:users,phone_number']);

        $user = User::wherePhoneNumber($request->phone_number)->first();
        $otp_code = $otp->generate($user->phone_number);
        $smsMessage = "Please use this OTP: $otp_code->token to reset your password";
        \App\Jobs\SendSMS::dispatch($user, $smsMessage);
        flash('Please Use OTP sent to reset your password')->success();
        return redirect()->route('password.reset.phone')->withInput();
    }

    public function changeView(Request $request, OtpService $otp){
        return view('auth.passwords.reset');
    }

    public function changePassword(Request $request, OtpService $otpVerification){
        $request->validate([
            'otp' => 'required|digits:6|exists:otps,otp',
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        $otp = Otp::whereOtp($request->otp)->first();
        if(!$otp){
            flash('Invalid OTP please request new one')->error();
            return redirect()->route('password.request')->withInput();
        }
        $user = User::wherePhoneNumber($otp->identifier)->first();
        if(!$user){
            flash('Invalid OTP please request new one')->error();
            return redirect()->route('password.request')->withInput();
        }

        $validateOtp = $otpVerification->validate($user->phone_number, $request->otp);
        if (!$validateOtp->status) {
            flash($validateOtp->message)->error();
            return redirect()->route('password.request')->withInput();
        }

        $user->update(['password' => Hash::make($request->password)]);
        flash('Password change successfully, please login with your new password!')->success();
        return redirect()->route('login')->withInput();
    }
}
