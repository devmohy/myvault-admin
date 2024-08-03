<?php

namespace App\Services;

use App\Enum\PaymentType;
use Exception;
use Throwable;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Savings;
use App\Models\Transaction;
use App\Enum\TransactionType;
use App\Enum\TransactionGroup;
use App\Enum\TransactionStatus;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use App\Services\TransactionService;

class SavingsService
{
  public $transactionService;

  public function __construct()
  {
    $this->transactionService = new TransactionService(new Transaction);
  }
  
  public function creditCashback(Savings $savings, $amount) : Transaction
  {
      $transaction = $this->transactionService->intiateTransaction(
        TransactionType::CREDIT,
        $savings->user,
        $amount,
        TransactionStatus::PENDING,
        TransactionGroup::SAVINGS,
        $savings->id,
      );
      $savings->creditCashBack($amount);
      $transaction->update([
        'transaction_status' => TransactionStatus::SUCCESSFUL,
        'payment_type' => PaymentType::INTEREST
      ]);
    return $transaction;
  }
  
  public function creditBalance(Savings $savings, $amount) : Transaction
  {
      $transaction = $this->transactionService->intiateTransaction(
        TransactionType::CREDIT,
        $savings->user,
        $amount,
        TransactionStatus::PENDING,
        TransactionGroup::SAVINGS,
        $savings->id,
      );
      $savings->creditCashBack($amount);
      $transaction->update([
        'status' => TransactionStatus::SUCCESSFUL,
        'payment_type' => PaymentType::INTEREST
      ]);
    return $transaction;
  }

  public function chargeCard($user, $cardId, $amount):bool
  {

      $source = $user->cards->find($cardId);
      if (!$source) {
        throw new CustomException("card not found", 404);
      }
      $charge = $source->debit($amount);
      if (!$charge){
        throw new CustomException("Error while charging user card", 400);
      }
      return false;
  
  }

  public function wallet($user, $walletId, $amount)
  {
    try {
      $source = $user->walletBalances->where('id', $walletId)->first();
      if (!$source) {
        throw new CustomException("wallet not found", 404);
      }

      if ($source->available_balance < $amount) {
        throw new CustomException("Insufficient funds available", 400);
      }

      $charge = $source->debit($amount);
      if ($charge) {
        // Wallet transaction
        $this->transactionService->createDebitTransaction($user, $amount, TransactionStatus::SUCCESSFUL, $source->id)->update(['narration' => "Savings Auto Charge"]);
      }else {
        throw new CustomException("Error while charging user wallet", 400);
      }
    } catch (Throwable $e) {
      return false;
    }

    return true;
  }

  public function chargeWallet($user, $walletId, $amount)
  {
    $transaction = $this->transactionService->intiateTransaction(
      TransactionType::DEBIT,
      $user,
      $amount,
      TransactionStatus::PENDING,
      TransactionGroup::WALLET,
      $walletId
    );
    try {
      $source = $user->walletBalances->where('id', $walletId)->first();
      if (!$source) {
        throw new CustomException("wallet not found", 404);
      }

      if ($source->available_balance < $amount) {
        throw new CustomException("Insufficient funds available", 400);
      }

      $charge = $source->debit($amount);
      if ($charge) {
        // Wallet transaction
        $transaction->update([
          'status'=> TransactionStatus::SUCCESSFUL,
          'narration' => "Savings Auto Charge"
        ]);
      }else {
        $transaction->update([
          'status'=> TransactionStatus::FAILED,
          'narration' => "Savings Auto Charge"
        ]);
        throw new CustomException("Error while charging user wallet", 400);
      }
    } catch (Throwable $e) {
      return false;
    }

    return true;
  }

  public function charge(User $user, string $charge_source_id, string $type, float $amount):bool{
    $source ="";
    if($type === "CARD"){
        $source = $this->chargeCard($user, $charge_source_id, $amount);
    } 
    if($type === "WALLET"){
        $source = $this->chargeWallet($user, $charge_source_id, $amount);
    }

    return $source;
}
}
