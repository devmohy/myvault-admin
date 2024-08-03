<?php

namespace App\Services;

use App\Models\User;
use App\Enum\TransactionType;
use App\Enum\TransactionGroup;
use App\Enum\TransactionStatus;
use App\Exceptions\CustomException;
use App\Models\Transaction;
use Throwable;

class ChargeService
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function card(User $user, $cardId, $amount, $trx): array
    {
        try {
            $source = $user->cards->find($cardId);
            if (!$source) {
                throw new CustomException("Card not found", 404);
            }

            $charge = $source->debit($amount, $trx);
            if (!$charge) {
                throw new CustomException("Error while charging user card", 400);
            }
        } catch (Throwable $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }

        return [
            'status' => 'success',
            'message' => "Charge card charge successful",
        ];
    }

    public function wallet(User $user, $walletId, $amount): array
    {
        try {
            $source = $user->walletBalances->where('id', $walletId)->first();
            if (!$source) {
                throw new CustomException("Wallet not found", 404);
            }

            if ($source->available_balance < $amount) {
                throw new CustomException("Insufficient funds available", 400);
            }

            $charge = $source->debit($amount);
            if ($charge) {
                // Wallet transaction
                $this->transactionService->createDebitTransaction($user, $amount, TransactionStatus::SUCCESSFUL, $source->id)->update(['narration' => "Savings Auto Charge"]);
            } else {
                throw new CustomException("Error while charging user wallet", 400);
            }
        } catch (Throwable $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }

        return [
            'status' => 'success',
            'message' => "Successfully charged user wallet",
        ];
    }

    public function charge(User $user, string $chargeSourceId, string $type, float $amount, Transaction $trx): array
    {
        if ($type == "CARD") {
            return $this->card($user, $chargeSourceId, $amount, $trx);
        }
        if ($type == "WALLET") {
            return $this->wallet($user, $chargeSourceId, $amount);
        }

        return [
            'status' => 'error',
            'message' => 'Invalid charge type',
        ];
    }
}
