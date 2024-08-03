<?php

namespace App\Services;

use App\Enum\PaymentType;
use Exception;
use App\Models\User;

use App\Models\Transaction;

use Illuminate\Support\Str;
use App\Enum\TransactionType;
use InvalidArgumentException;
use App\Enum\TransactionGroup;
use App\Enum\TransactionStatus;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Uid\Ulid;

class TransactionService { 

    /**
     * @var $transactionRepository
    */
    protected $transaction;

    /**
     * TransactionService constructor
     * 
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Debit a User
     * 
     * @param User $customer
     * @param float $amount
     * @param string $status
     * @return Transaction $transaction
     */
    public function createDebitTransaction(
      User $customer, 
      $amount,
      TransactionStatus $status = TransactionStatus::SUCCESSFUL, 
      $wallet_id = null, 
      $card_id = null, 
      $savings_id = null
    ): Transaction
    {
        DB::beginTransaction();
        try{ 
            $data = [
                'type' => TransactionType::DEBIT,
                'user_id' => $customer->id,
                'wallet_id' => $wallet_id,
                'savings_id' => $savings_id,
                'card_id' => $card_id,
                'reference' => strtoupper(Str::random(30)),
                'amount' => $amount,
                'total_amount' => $amount,
                'transaction_status' => $status,
            ];
            $transaction = $this->transaction->create($data); 
        }catch (Exception $e) { 
            DB::rollBack();
            throw new InvalidArgumentException($e->getMessage()); 
        }
        DB::commit();
        return $transaction;
    }

    public function createCreditTransaction(
      User $customer, 
      $amount, 
      TransactionStatus $status = TransactionStatus::SUCCESSFUL,
      string $wallet_id = null, 
      string $card_id = null, 
      string $savings_id = null,
    ): Transaction
    {
        DB::beginTransaction();
        try{ 
            $data = [
                'type' => "CREDIT",
                'user_id' => $customer->id,
                'phone_number' => $customer->phone_number,
                'reference' => strtoupper(Str::random(30)),
                'amount' => $amount,
                'wallet_id' => $wallet_id,
                'card_id' => $card_id,
                'savings_id' => $savings_id, 
                'transaction_status' => $status,
            ];
            $transaction = $this->transaction->create($data); 
        }catch (Exception $e) { 
            DB::rollBack();
            throw new InvalidArgumentException($e->getMessage()); 
        }
        DB::commit();
        return $transaction;
    }

    public function intiateTransaction(
        TransactionType $type,
        User $customer, 
        float $amount, 
        TransactionStatus $status,
        TransactionGroup $trxGroup,
        string $trxGroupId = null,
        float $fee = 0.00
    ): Transaction
    {
        DB::beginTransaction();
        try{ 
            $data = [
                'type' => $type,
                'user_id' => $customer->id,
                'trx_group' => $trxGroup,
                'trx_group_id' => $trxGroupId,
                'reference' => Ulid::generate(),
                'phone_number' => $customer->phone_number,
                'amount' => $amount,
                'total_amount' => $amount+$fee,
                'fee_amount' => $fee,
                'transaction_status' => $status
            ];
            $transaction = $this->transaction->create($data); 
        }catch (Exception $e) { 
            DB::rollBack();
            throw new InvalidArgumentException($e->getMessage()); 
        }
        DB::commit();
        return $transaction;
    }

}