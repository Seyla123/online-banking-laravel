<?php 

namespace App\Services\Transactions;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;

class WithdrawTransaction implements TransactionInterface
{
    private TransactionRepository $repository;
    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }
    public function process(array $data): Transaction
    {
        return $this->repository->create([
            'amount' => $data['amount'],
            'user_id' => $data['user_id'],
            'transaction_type' => 'withdrawal',
            'bank_account_id' => $data['selectedBankAccount'],
            'source_wallet_id' => $data['walletId'],
            'reference_code' => $data['reference_code'],
        ]);
    }
}