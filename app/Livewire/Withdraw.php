<?php

namespace App\Livewire;

use App\Services\BankAccountService;
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
    public function boot(
        BankAccountService $bankAccountService,
        TransactionService $transactionService
    ) {
        $this->bankAccountService = $bankAccountService;
        $this->transactionService = $transactionService;
    }
    public function save()
    {
        // validate data
        $validated = $this->validate(
            WithdrawValidateRules::rules(),
            WithdrawValidateRules::messages()
        );

        // pass data to TransactionService to create pending transaction 
        $transaction = $this->transactionService->createTransaction( $validated, 'withdrawal');

        // create checkout and verify otp 
        // if success set transaction status to completed
        // else set transaction status to failed
        // TODO: implement checkout
        
        // if (!$transaction) {
        //     session()->flash('success', 'ការដកប្រាក់បានជោគជ័យ');
        //     return $this->redirect('/withdraw', navigate: true);
        // }

        // //session()->flash('success', 'ការដកប្រាក់បានជោគជ័យ');
        session()->flash('fail', 'បរាជ័យក្នុងការដកប្រាក់');
        $this->redirect('/withdraw', navigate: true);
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
            'wallet',
            'bankAccounts.bank',
            'primaryBankAccount'
        ]);
        $primaryBankAccount = $primaryBankAccount->bank_account_id ?? $user->bankAccounts[0]->id;
        $wallet = $user->wallet->first();
        $this->walletId = $wallet->id;

        return view('livewire.pages.withdraw', [
            'wallet' => $wallet,
            'bankAccounts' => $user->bankAccounts,
            'primaryBankAccount' => $primaryBankAccount,
            'user' => $user
        ]);
    }
}
