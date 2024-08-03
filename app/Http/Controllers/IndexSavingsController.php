<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SavingsResource;
use App\Models\Savings;
use Illuminate\Http\Request;

class IndexSavingsController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $savings = Savings::with('user')->latest()->paginate(10);
        return $this->sendResponse($savings, "List of transactions fetched successfully", 200, function ($items) {
            return SavingsResource::collection($items);
        });
    }
}