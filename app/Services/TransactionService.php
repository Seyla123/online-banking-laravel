<?php

namespace App\Services;

use App\Interfaces\TransactionInterface;
use App\Models\Checkout;
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
    private WalletService $walletService;
    private DepositTransaction $depositTransaction;
    private WithdrawTransaction $withdrawTransaction;
    private TransferTransaction $transferTransaction;
    private CheckoutService $checkoutService;
    public function __construct(
        TransactionRepository $repository,
        WalletService $walletService,
        DepositTransaction $depositTransaction,
        WithdrawTransaction $withdrawTransaction,
        TransferTransaction $transferTransaction,
        CheckoutService $checkoutService
    ) {
        $this->repository = $repository;
        $this->walletService = $walletService;
        $this->depositTransaction = $depositTransaction;
        $this->withdrawTransaction = $withdrawTransaction;
        $this->transferTransaction = $transferTransaction;
        $this->checkoutService = $checkoutService;
    }
    /**
     * create transaction base on transaction type ('deposit', 'withdrawal', 'transfer')
     * @param array $data
     * @param string $transactionType type of transaction ('deposit', 'withdrawal', 'transfer')
     * @return void
     */
    public function createTransaction(array $data, string $transactionType): ?Transaction
    {
        try {
            //prepare data 
            $data = array_merge($data, [
                'reference_code' => $this->generateReferenceCode(),
                'transaction_type' => $transactionType,
            ]);

            // Check if the wallet has sufficient balance for (withdrawal, transfer)
            if ($transactionType == 'withdrawal' || $transactionType == 'transfer') {
                $this->walletService->hasSufficientBalance($data['amount']);
            }

            // Determine which transaction type to create
            $transaction = $this->getTransactionInstance($transactionType);


            // Process the transaction and get the created transaction
            return $transaction->process($data);

            // pass created transaction to WalletService 
            // to be able to update (add or subtract) the balance in the wallet
            // $this->walletService->updateBanlance($createdTransaction);

            // session()->flash('success', 'ការដកប្រាក់បានជោគជ័យ');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Transaction creation failed: ' . $e->getMessage());
            if (config('app.env') == 'production') {
                session()->flash('fail', 'បរាជ័យក្នុងការដកប្រាក់');
            } else {
                session()->flash('fail', $e->getMessage());
            }
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
                return $this->depositTransaction;
            case 'withdrawal':
                return $this->withdrawTransaction;
            case 'transfer':
                return $this->transferTransaction;
            default:
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
