<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class IndexCustomerController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
       $data = Customer::latest()->paginate(10);

       return $this->sendResponse($data, "Customer retrieved successfully", 200, function ($items) {
        return CustomerResource::collection($items);
    });
    }
}
