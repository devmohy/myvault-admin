<?php

namespace App\Http\Controllers\Investment;

use App\Models\Property;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexInvestmentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if($request->user_id == 'undefined'){
            $request->merge(['user_id' => 0]);
        }
        return Investment::with('property', 'user')->when(($request->user_id>0), fn($q)=>$q->where('user_id', $request->user_id))->latest()->paginate(10);
        
    }
}
