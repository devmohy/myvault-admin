<?php

namespace App\Http\Controllers\InvestmentMember;

use App\Models\Property;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InvestmentClub;

class IndexInvestmentMemberController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return InvestmentClub::with('user')->latest()->paginate(10);
        
    }
}
