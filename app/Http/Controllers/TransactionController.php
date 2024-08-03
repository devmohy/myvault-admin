<?php

namespace App\Http\Controllers;

use App\Enum\TransactionStatusEnum;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionDetailsResource;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\QueryBuilders\TransactionQueryBuilder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

class TransactionController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaction::with('user');
        $query = TransactionQueryBuilder::applyFilters($query, $request);
        $transactions = $query->latest()->paginate($request->per_page ?? 10);
        return $this->sendResponse($transactions, "List of transactions fetched successfully", 200, function ($items) {
            return TransactionResource::collection($items);
        });
    }

    public function stat(Request $request) {
        $statusStat = DB::table('transactions')
                    ->selectRaw('status, COALESCE(COUNT(id), 0) as count')
                    ->when(auth()->user()->business_id, function ($q) {
                        return $q->where('business_id', '=', auth()->user()->business_id);
                    })
                    ->whereIn('status', [TransactionStatusEnum::PENDING, TransactionStatusEnum::SUCCESSFUL, TransactionStatusEnum::FAILED])
                    ->groupBy('status')
                    ->get();
    
        $summaries['statuses'] = $statusStat;
        return response()->json(['summaries' => $summaries]);
    }

    public function transactionSumStat(Request $request) {
        $transactionSumStat = DB::table('transactions')
                    ->selectRaw('status, SUM(amount) as total')
                    ->when(auth()->user()->business_id, function ($q) {
                        return $q->where('business_id', '=', auth()->user()->business_id);
                    })
                    ->whereIn('status', [TransactionStatusEnum::PENDING, TransactionStatusEnum::SUCCESSFUL, TransactionStatusEnum::FAILED])
                    ->groupBy('status')
                    ->get();
    
        //$summaries['sumstats'] = $transactionSumStat;
        return response()->json(['summaries' => $transactionSumStat]);
    }

    public function fetchTransactionsByEmployeeId(Request $request)
    {
        $query = Transaction::with('business');
        $query = TransactionQueryBuilder::applyFilters($query, $request);
        $transactions = $query->latest()->paginate($request->per_page ?? 10);
        return $this->sendResponse($transactions, "List of transactions fetched successfully", 200, function ($items) {
            return TransactionResource::collection($items);
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $transaction = Transaction::with('business', 'payroll')->find($id);

            if (!$transaction) { 
                return response()->json([
                    'message' => 'Transaction doesn\'t exist',
                ], 400);
            }
            
            return response()->json([
                'data' => new TransactionDetailsResource($transaction),
                'message' => 'Transaction details fetched successfully',
                'code' => 200,
            ], 200);

        }catch (Throwable $e) {
            return response()->json([
                'message' => "Error fetching transaction details " . $e->getMessage(),
            ], 500);
        }
    }

    public function export() {

        $transactions = null;
        if(auth()->user()->business_id) {
            $this->$transactions = Transaction::where('business_id', auth()->user()->business_id)->get();
        }else {
            $this->$transactions = Transaction::all();
        }
        

        $csvFileName = 'transaction.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Reference', 'Status', 'Type', 'Employee Name', 'Amount', 'Narration']); // Add more headers as needed

        foreach ($this->$transactions as $transaction) {
            fputcsv($handle, [$transaction->reference, $transaction->status, $transaction->type, optional($transaction->employee)->name, $transaction->amount, $transaction->narration]); // Add more fields as needed
        }

        fclose($handle);

        return response('', 200, $headers);
    }

    public function exportByDateRange(Request $request) {

        $this->validate($request, [
            "fromDate" => "required|string|date|date_format:Y-m-d",
            "toDate" => "required|string|date|date_format:Y-m-d|after_or_equal:fromDate",
        ]);

        $transactions = null;

        $fromDate = Carbon::createFromFormat('Y-m-d', $request->fromDate)->startOfDay();
        $toDate = Carbon::createFromFormat('Y-m-d', $request->toDate)->endOfDay();

        if(auth()->user()->business_id) {
            $this->$transactions = Transaction::where('business_id', auth()->user()->business_id)->whereBetween('created_at', [$fromDate, $toDate])->get();
        }else {
            $this->$transactions = Transaction::whereBetween('created_at', [$fromDate, $toDate])->get();
        }
        

        $csvFileName = 'transaction.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Reference', 'Status', 'Type', 'Employee Name', 'Amount', 'Narration', 'Date Created']); // Add more headers as needed

        foreach ($this->$transactions as $transaction) {
            fputcsv($handle, [$transaction->reference, $transaction->status, $transaction->type, optional($transaction->employee)->name, $transaction->amount, $transaction->narration, $transaction->created_at->format('d/m/Y @ h:iA')]); // Add more fields as needed
        }

        fclose($handle);

        return response('', 200, $headers);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}