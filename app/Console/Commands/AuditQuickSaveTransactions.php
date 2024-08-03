<?php

namespace App\Console\Commands;

use App\Models\Savings;
use App\Models\Customer;
use App\Models\LogAudit;
use App\Models\RequestLog;
use App\Services\Paystack;
use App\Models\Transaction;
use App\Models\SuspectedUsers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Exceptions\PaystackServiceException;
use App\Models\SavingsBalance;
use App\Models\WalletBalance;

class AuditQuickSaveTransactions extends Command
{
    protected $signature = 'audit:quick-save-transactions';

    protected $description = 'audit quick save transactions';

    public function handle()
    {
        RequestLog::where('url', 'like', '%add-money%')
            ->whereJsonContains('response->message', 'Savings fundend successfully')
            ->chunk(200, function ($logs) {
                foreach ($logs as $log) {
                    $url = $log->url;
                    preg_match('/\/(\d+)\/add-money/', $url, $matches);
                    $savingsId = $matches[1];
                    $this->info('Start Audit '.$savingsId);


                    if ($log['request']['charge_source_type'] == "CARD") {
                        $this->processCardTransaction($savingsId, $log);
                    } else{
                        $this->processWalletTransaction($savingsId, $log);
                    }
                }
            });

        $this->info('Quick save transactions processed successfully.');
    }

    private function processCardTransaction($savingsId, $log)
    {

        $this->info('Processing Audit Savings ID:'.$savingsId. 'Card Transaction');
        DB::transaction(function () use ($savingsId, $log) {
            $savings = Savings::find($savingsId);
            $transactions = Transaction::whereTrxGroupId($savingsId)
                ->whereTrxGroup('savings')
                ->whereNull('payment_type')
                ->whereTransactionStatus('PENDING')
                ->latest()
                ->get();

            foreach ($transactions as $trx) {
                if (!$this->isTransactionAudited($trx)) {
                try {
                    $user = Customer::find($trx->user_id);
                    $savingsCashbackTrx = $transactions
                        ->where('payment_type', 'interest')
                        ->where('transaction_status', 'SUCCESSFUL')
                        ->first();

                    $paystack = new Paystack(new Http);
                    $response = $paystack->verifyTransaction($trx->reference);

                    if ($response['data']['status'] !== "success") {
                        $this->handleFailedTransaction($savings, $trx, $savingsCashbackTrx, $user, $log);
                        $this->info('Transaction Verification failed TrxID:'.$savingsId);
                        // Log transaction details
                        $this->logTransactionDetails($trx, $user, $log);
                    }
                } catch (PaystackServiceException $e) {
                    // $this->handleFailedTransaction($savings, $trx, $savingsCashbackTrx, $user, $log);
                    // $this->info('Transaction Verification failed TrxID:'.$savingsId);
                    // // Log transaction details
                    // $this->logTransactionDetails($trx, $user, $log);
                }
            }
            }
        });
    }
    private function processWalletTransaction($savingsId, $log)
    {

        $this->info('Processing Audit Savings ID:'.$savingsId. 'Wallet Transaction');
        DB::transaction(function () use ($savingsId, $log) {
            $savings = Savings::find($savingsId);
            $transactions = Transaction::whereTrxGroupId($savingsId)
                ->whereTrxGroup('savings')
                ->whereNull('payment_type')
                ->whereTransactionStatus('PENDING')
                ->latest()
                ->get();

            foreach ($transactions as $trx) {
                if (!$this->isTransactionAudited($trx)) {
                try {
                    $user = Customer::find($trx->user_id);
                    $savingsCashbackTrx = $transactions
                        ->where('payment_type', 'interest')
                        ->where('transaction_status', 'SUCCESSFUL')
                        ->first();

                    $walletTransaction = WalletBalance::whereUserId($user->id)->wallet('PAYMYRENT')->first();
                    
                    $walletTrx= Transaction::whereType('DEBIT')->whereUserId($user->id)->where('transaction_status', 'SUCCESSFUL')
                                                    ->whereAmount($trx->amount)->whereTrxGroup('wallet')
                                                    ->whereTrxGroupId($walletTransaction->id)->first();

                    if (!$walletTrx) {
                        $this->handleFailedTransaction($savings, $trx, $savingsCashbackTrx, $user, $log);
                        $this->info('Transaction Verification failed TrxID:'.$savingsId);
                        // Log transaction details
                        $this->logTransactionDetails($trx, $user, $log);
                    }
                } catch (PaystackServiceException $e) {
                    // $this->handleFailedTransaction($savings, $trx, $savingsCashbackTrx, $user, $log);
                    // $this->info('Transaction Verification failed TrxID:'.$savingsId);
                    // // Log transaction details
                    // $this->logTransactionDetails($trx, $user, $log);
                }
            }
            }
        });
    }

    private function isTransactionAudited($transaction)
    {
        return LogAudit::where('group', 'transaction')
            ->where('group_id', $transaction->id)
            ->exists();
    }

    private function logTransactionDetails($transaction, $user, $log)
    {
        // Log transaction details as needed
        Log::info("Processing fruad transaction ID: {$transaction->id} for user ID: {$user->id}. Log ID: {$log->id}");
    }

    private function handleFailedTransaction($savings, $trx, $savingsCashbackTrx, $user, $log)
    {
        $savings->balance->debit($trx->amount);

        $trx->update([
            'transaction_status' => 'FAILED'
        ]);

        $savingsBalance = SavingsBalance::whereUserId($user->id)->whereSavingsId($savings->id)->first();


        echo "SavingsBalanceId: {$savingsBalance->id} for user ID: {$user->id}. Log ID: {$log->id} \n";

        $savingsBalance->update([
            'available_balance' => $savingsBalance->available_balance - abs($trx->amount)
        ]);
        
        if (isset($savingsCashbackTrx)) {
            $savingsCashbackTrx->update([
                'transaction_status' => 'FAILED'
            ]);
            $cashBackWallet = WalletBalance::whereUserId($user->id)->wallet('CASHBACK')->first();
            $cashBackWallet->update([
                'available_balance' => $cashBackWallet->available_balance - abs($savingsCashbackTrx->amount)
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

        SuspectedUsers::updateOrCreate(
            ['user_id' => $user->id],[
            'user_id' => $user->id,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'name' => "$user->first_name $user->last_name",
        ]);
    }
}
