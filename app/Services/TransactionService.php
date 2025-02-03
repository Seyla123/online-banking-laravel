<?php

namespace App\Services;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use App\Services\Transactions\DepositTransaction;
use App\Services\Transactions\TransferTransaction;
use App\Services\Transactions\WithdrawTransaction;
use Illuminate\Support\Facades\DB;
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
     * @return ?Transaction
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
                throw new \InvalidArgumentException('Transaction type មិនត្រឹមត្រូវទេ');
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
    /**
     * confirm transaction ,update wallet balance and update transaction status and checkout status
     * @param \App\Models\Transaction $transaction
     * @throws \Exception
     * @return void
     */
    public function confirmTransaction(Transaction $transaction)
    {
        DB::beginTransaction();
        try {
            if (!$transaction) {
                throw new \Exception('រកមិនឃើញ transaction មួយនេះទេ');
            }

            // update balance in wallet
            $this->walletService->updateBanlance($transaction);

            // update transaction status
            $this->repository->update($transaction, ['status' => 'confirmed']);

            // update checkout status
            $this->checkoutService->confirmCheckout($transaction->checkout);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
            throw new \Exception($th->getMessage());
        }

    }
    /**
     * check transaction exists or checkout exists or expired
     * @param string $referenceCode
     * @throws \Exception
     * @return Transaction
     */
    public function checkTransaction(string $referenceCode): Transaction
    {
        $transaction = Transaction::where('reference_code', $referenceCode)->first();
        if (!$transaction) {
            throw new \Exception('រកមិនឃើញ transaction មួយនេះទេ');
        }

        // check if checkout exists or expired
        $this->checkoutService->checkIfCheckoutExistsOrExpired($transaction);

        return $transaction;
    }

}
