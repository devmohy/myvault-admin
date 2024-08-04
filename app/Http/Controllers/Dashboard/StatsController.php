<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
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
        $savingsQuery = DB::connection('vault')->table('savings')
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

    public function genderDistribution()
    {
        // Get the count of each gender
        $genderCounts = Customer::select('gender', DB::raw('count(*) as count'))
            ->groupBy('gender')
            ->pluck('count', 'gender')
            ->toArray();

        // Define the labels and data for the chart
        $labels = ['Male', 'Female', 'Others'];
        $data = [
            $genderCounts['MALE'] ?? 0,
            $genderCounts['FEMALE'] ?? 0,
            $genderCounts[''] ?? 0,
        ];

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function savingsTransition()
    {
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])
                                   ->selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(amount) as total')
                                   ->groupBy('date')
                                   ->orderBy('date')
                                   ->get();

        $labels = $transactions->pluck('date');
        $data = $transactions->pluck('total');

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
