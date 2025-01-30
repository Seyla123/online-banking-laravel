<?php

namespace App\Livewire;

use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Withdraw extends Component
{
    #[Title('ដកប្រាក់')]
    public $amount = 0;
    public $selectedBankAccount;

    public function save()
    {
        // // Server-side validation
        $validated = $this->validate([
            'amount' => 'required|numeric|lte:' . auth()->user()->wallet->first()->balance,
            'selectedBankAccount' => 'required|exists:bank_accounts,id'
        ], [
            'amount.required' => 'សូមបញ្ជូលចំនួនទឹកប្រាក់ជាមុនសិន !',
            'amount.lte' => 'ទឹកប្រាក់មិនគ្រប់គ្រាន់',
            'selectedBankAccount.required' => 'សូមជ្រើសរើសគណនីធនាគារ'
        ]);
        
        //session()->flash('success', 'ការដកប្រាក់បានជោគជ័យ');
        session()->flash('fail', 'បរាជ័យក្នុងការដកប្រាក់');
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
