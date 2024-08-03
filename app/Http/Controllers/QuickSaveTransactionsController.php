<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Savings;
use App\Models\Customer;
use App\Models\RequestLog;
use App\Services\Paystack;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Http;
use App\Exceptions\PaystackServiceException;
use App\Models\LogAudit;
use App\Models\SuspectedUsers;

class QuickSaveTransactionsController extends Controller
{
    public function index()
    {
        $logs = RequestLog::where('url', 'like', '%add-money%')
            ->whereJsonContains('response->message', 'Savings fundend successfully')
            ->take(5)
            ->get();

        foreach ($logs as $log) {
            $url = $log->url;
            preg_match('/\/(\d+)\/add-money/', $url, $matches);
            $savingsId = $matches[1];

            if ($log['request']['charge_source_type'] == "CARD") {
                $this->processCardTransaction($savingsId, $log);
            }
        }
    }

    private function processCardTransaction($savingsId, $log)
    {
        DB::transaction(function () use ($savingsId, $log) {
            $savings = Savings::find($savingsId);
            $transactions = Transaction::whereTrxGroupId($savingsId)
                ->whereTrxGroup('savings')
                ->whereNull('payment_type')
                ->whereTransactionStatus('PENDING')
                ->latest()
                ->get();

            foreach ($transactions as $trx) {
                try {
                    $user = Customer::find($trx->user_id);
                    $savingsCashbackTrx = $transactions
                        ->where('payment_type', 'interest')
                        ->where('transaction_status', 'SUCCESSFUL')
                        ->first();

                    $paystack = new Paystack(new Http);
                    $response = $paystack->verifyTransaction($trx->reference);

                    if ($response['data']['status'] !== "success") {
                        throw new CustomException("Transaction failed", 400);
                    }
                } catch (PaystackServiceException $e) {
                    $this->handleFailedTransaction($savings, $trx, $savingsCashbackTrx, $user, $log);
                }
            }
        });
    }

    private function handleFailedTransaction($savings, $trx, $savingsCashbackTrx, $user, $log)
    {
        $savings->balance->debit($trx->amount);

        $trx->update([
            'transaction_status' => 'FAILED'
        ]);

        if(isset($savingsCashbackTrx)){
              $savingsCashbackTrx->update([
                'transaction_status' => 'FAILED'
            ]);
        }
        $user->update(['is_suspended' => true]);
        
        LogAudit::create([
            'log_id' => $log->id,
            'user_id' => $user->id,
            'report' => "Fraud",
            'type' => 'fraud', 
            'group' => "transaction",
            'group_id' => $trx->id,
        ]);

        SuspectedUsers::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'name' => "$user->first_name $user->last_name",
        ]);
    }
}
