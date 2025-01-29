<?php

namespace App\Livewire;

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
        $user = Auth::user();
        $wallet = $user->wallet->first();   
        $bankAccounts=$user->bankAccounts; 
        $primaryBankAccount=$user->primaryBankAccount;
        
        return view('livewire.pages.withdraw',[
            'wallet' => $wallet,
            'bankAccounts' => $bankAccounts,
            'primaryBankAccount' => $primaryBankAccount,
            'user'=>$user
        ]);
    }
}
