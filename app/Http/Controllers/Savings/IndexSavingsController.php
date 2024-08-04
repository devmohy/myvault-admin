<?php

namespace App\Http\Controllers\Savings;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Savings;
use Illuminate\Http\Request;

class IndexSavingsController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if($request->user_id == 'undefined'){
            $request->merge(['user_id' => 0]);
        }

        if($request->due_date == 'undefined'){
            $request->merge(['due_date' => 'today']);
        }
        $savings = Savings::with('user','transactions')
        ->when($request->user_id > 0, fn ($q) => $q->where('user_id', $request->user_id))
        ->when($request->due_date == 'today', fn ($q) => $q->whereDate('end_date', now()))
        ->when($request->due_date == 'tomorrow', fn ($q) => $q->whereDate('end_date', now()->addDay()))
        ->when($request->due_date == 'month', fn ($q) => $q->whereMonth('end_date', date('m')))
        ->when($request->due_date == 'year', fn ($q) => $q->whereYear('end_date', date('Y')))
        ->latest()
        ->latest()->paginate(10);


        return $this->sendResponse($savings, "Customer retrieved successfully", 200);
    }
}
