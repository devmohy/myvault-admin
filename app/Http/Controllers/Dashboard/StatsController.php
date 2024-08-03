<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Business;
use App\Models\Employee;
use App\Enum\LoanStatusEnum;
use Illuminate\Http\Request;
use App\Enum\EmployeeStatusEnum;
use App\Enum\PayrollStatusEnum;
use App\Enum\TransactionStatusEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $summaries = [];
        // Query to get summaries for savings
        $savingsQuery = DB::connection('vualt')->table('savings')
        ->join('savings_balances', 'savings.id', '=', 'savings_balances.savings_id')
        ->selectRaw('SUM(savings_balances.available_balance) as total');
        $savingsSummary = $savingsQuery->first();

        $summaries[] = [
            'title' => 'Total savings',
            'total' => '₦' . number_format($savingsSummary->total, 2, '.', ','),
        ];

        // Query to get summaries for savings
        $interestBalanceQuery = DB::connection('vault')->table('wallet_balances')
        ->where('wallet_id', 2)
        ->selectRaw('SUM(wallet_balances.available_balance) as total');
        $interestBalanceSummary = $interestBalanceQuery->first();

        $summaries[] = [
            'title' => 'Total interests',
            'total' => '₦' . number_format($interestBalanceSummary->total, 2, '.', ','),
        ];

        // Query to get summaries for savings
        $walletBalanceQuery = DB::connection('vault')->table('wallet_balances')
        ->where('wallet_id', 1)
        ->selectRaw('SUM(wallet_balances.available_balance) as total');
        $walletBalanceSummary = $walletBalanceQuery->first();

        $summaries[] = [
            'title' => 'Total wallet balance',
            'total' => '₦' . number_format($walletBalanceSummary->total, 2, '.', ','),
        ];

        return response()->json(['data' => $summaries]);

    }
}
