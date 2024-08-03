<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required|digits:11|unique:users,phone_number',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        return User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'phone_number' => request('phone_number'),
            'email' => request('email'),
            'password' => bcrypt('password'),
        ]);
    }
}
