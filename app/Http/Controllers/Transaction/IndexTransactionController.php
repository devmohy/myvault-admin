<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Savings;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexTransactionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if($request->user_id == 'undefined'){
            $request->merge(['user_id' => 0]);
        }
        return Transaction::with('user')->when(($request->user_id>0), fn($q)=>$q->where('user_id', $request->user_id))->latest()->paginate(5);
    }
}
