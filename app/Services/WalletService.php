<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Wallet;
use App\Repositories\WalletRepository;

class WalletService
{
    private WalletRepository $repository;
    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * update wallet balance base on transaction type (withdrawal, deposit, transfer)
     * @param \App\Models\Transaction $transaction
     * @throws \InvalidArgumentException
     * @throws \Exception
     * @return void
     */
    public function updateBanlance(Transaction $transaction): void
    {

        switch ($transaction->transaction_type) {
            case 'withdrawal':
                $this->withdrawFunds($transaction->amount);
                break;
            case 'deposit':
                $this->depositFunds($transaction->amount);
                break;
            case 'transfer':
                $this->transferFunds($transaction->amount);
                break;
            default:
                throw new \InvalidArgumentException('Invalid transaction type');
        }
    }
    /**
     * withdraw funds and update (subtract) wallet balance
     * @param float $amount
     * @throws \Exception
     * @return void
     */
    private function withdrawFunds(float $amount): void
    {
        // check if wallet has sufficient balance
        $this->hasSufficientBalance($amount);
        // update (subtract) wallet balance
        $this->repository->withdraw($amount);
    }
    /**
     * deposit funds and update (add) wallet balance
     * @param float $amount
     * @return void
     */
    private function depositFunds(float $amount): void
    {
        $this->repository->deposit($amount);
    }
    /**
     * transfer funds and update (subtract) wallet balance
     * @param float $amount
     * @throws \Exception
     * @return void
     */
    private function transferFunds(float $amount): void
    {
        // check if wallet has sufficient balance
        $this->hasSufficientBalance($amount);

        // update (subtract) wallet balance
        $this->repository->transfer($amount);
    }
    public function hasSufficientBalance(float $amount)
    {
        if ($amount > $this->repository->currentBalance()) {
            throw new \Exception('ទឹកប្រាក់មិនគ្រប់គ្រាន់');
        }
        return true;
    }
}