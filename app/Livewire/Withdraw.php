<?php

namespace App\Livewire;

use App\Repositories\WalletRepository;
use App\Services\BankAccountService;
use App\Services\CheckoutService;
use App\Services\TransactionService;
use App\Validations\WithdrawValidateRules;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Withdraw extends Component
{
    #[Title('ដកប្រាក់')]
    public $amount = 0;
    public $selectedBankAccount;
    public $walletId;
    private BankAccountService $bankAccountService;
    private TransactionService $transactionService;
    private WalletRepository $walletRepository;
    private CheckoutService $checkoutService;
    public function boot(
        BankAccountService $bankAccountService,
        TransactionService $transactionService,
        WalletRepository $walletRepository,
        CheckoutService $checkoutService
    ) {
        $this->bankAccountService = $bankAccountService;
        $this->transactionService = $transactionService;
        $this->walletRepository = $walletRepository;
        $this->checkoutService = $checkoutService;
    }
    public function save()
    {
        // validate data
        $validated = $this->validate(
            WithdrawValidateRules::rules(),
            WithdrawValidateRules::messages()
        );

        // pass data to TransactionService to create transaction
        $transaction = $this->transactionService->createTransaction($validated, 'withdrawal');

        // pass data to checkoutService to create checkout
        $this->checkoutService->createCheckout($transaction);

        // if success redirect to checkout to verify the transaction
        $this->redirect(route('checkout', [
            'referenceCode' => $transaction->reference_code
        ]), navigate: true);

    }
    #[On('delete-bank-account')]
    public function deleteBankAccount($id)
    {
        //pass data to BankAccountService
        $this->bankAccountService->deleteBankAccount($id);

        $this->redirect('/withdraw', navigate: true);
    }
    public function render()
    {
        $user = Auth::user()->load([
            'bankAccounts.bank',
            'primaryBankAccount'
        ]);

        // if primary bank account is not set, set it to the first bank account
        $primaryBankAccount = $user->primaryBankAccount->bankAccount ? $user->primaryBankAccount->bank_account_id : $user->bankAccounts[0]->id;

        // get wallet 
        $wallet = $this->walletRepository->getWallet();

        // set wallet id
        $this->walletId = $wallet->id;

        return view('livewire.pages.withdraw', [
            'wallet' => $wallet,
            'bankAccounts' => $user->bankAccounts,
            'primaryBankAccount' => $primaryBankAccount,
        ]);
    }
}
