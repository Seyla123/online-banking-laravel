<?php

namespace App\Services;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use App\Services\Transactions\DepositTransaction;
use App\Services\Transactions\TransferTransaction;
use App\Services\Transactions\WithdrawTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class TransactionService
{
    private TransactionRepository $repository;
    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }
    public function createTransaction(array $data, string $transactionType)
    {
        try {
            // Add user id and reference code to the transaction data
            $data = array_merge($data, [
                'user_id' => Auth::id(),
                'reference_code' => $this->generateReferenceCode(),
                'transaction_type' => $transactionType,
            ]);

            // Determine which transaction type to create
            $transaction = $this->getTransactionInstance($transactionType);

            // Process the transaction and return the result
            return $transaction->process($data);

        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Transaction creation failed: ' . $e->getMessage());
            throw new \RuntimeException('Transaction could not be created.');
        }
    }
    /**
     * get transaction instance ('deposit', 'withdrawal', 'transfer')
     * @param string $transactionType
     * @throws \InvalidArgumentException
     * @return TransactionInterface
     */
    private function getTransactionInstance(string $transactionType): TransactionInterface
    {
        switch ($transactionType) {
            case 'deposit':
                return new DepositTransaction($this->repository);
            case 'withdrawal':
               return new WithdrawTransaction($this->repository);
            case 'transfer':
               return new TransferTransaction($this->repository);
            default:
                // Throw an exception if the transaction type is invalid
                throw new \InvalidArgumentException('Invalid transaction type');
        } 
    }
    /**
     * gerate unique reference code
     * @return string
     */
    public function generateReferenceCode(): string
    {
        return Str::uuid();
    }
}
