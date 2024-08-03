<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
           // Check if user is authenticated
           if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

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

            if ($user->business && ($user->business->status === 'inactive' || $user->business->status === 'blacklisted')) {
                return response()->json([
                    'message' => "Business is $user->status",
                ], 401);
            }
        }
        return $next($request);
    }
}
