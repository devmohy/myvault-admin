<?php

namespace App\Http\Controllers\Profile;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Profile\ChangePasswordRequest;
use App\Jobs\Profile\SendPasswordChangedEmailJob;

class ChangePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ChangePasswordRequest $request)
    {
        $user = $request->user();
        if (!$user || !Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Invalid current password'],
            ]);
        }
        DB::beginTransaction();
        try {
            $user->update(['password' => Hash::make($request->new_password)]);
            dispatch(new SendPasswordChangedEmailJob($user));
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['message' => 'Password Changed successfully']);
    }
}
