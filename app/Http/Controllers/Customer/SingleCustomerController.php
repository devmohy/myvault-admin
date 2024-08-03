<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SingleCustomerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        return Customer::latest()->findOrFail($id);
    }
}
