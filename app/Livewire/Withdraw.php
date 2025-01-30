<?php

namespace App\Livewire;

use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Withdraw extends Component
{
    #[Title('ដកប្រាក់')]
    public $balance = 26490;
    public $walletNumber = '123142343214';
    public $phone = '962059095';

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
