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
        return Transaction::with('user')->latest()->paginate(10);
    }
}
