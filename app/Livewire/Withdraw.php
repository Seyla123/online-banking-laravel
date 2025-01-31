<?php

namespace App\Livewire;

use App\Services\BankAccountService;
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
    private BankAccountService $bankAccountService;
    public function boot(BankAccountService $bankAccountService)
    {
        $this->bankAccountService = $bankAccountService;
    }
    public function save()
    {
        // validate data
        $this->validate(
            WithdrawValidateRules::rules(), 
            WithdrawValidateRules::messages());
        
        //session()->flash('success', 'ការដកប្រាក់បានជោគជ័យ');
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

        return view('livewire.pages.withdraw', [
            'wallet' => $user->wallet->first(),
            'bankAccounts' => $user->bankAccounts,
            'primaryBankAccount' => $user->primaryBankAccount,
            'user' => $user
        ]);
    }
}
