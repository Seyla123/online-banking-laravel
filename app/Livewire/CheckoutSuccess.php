<?php

namespace App\Livewire;

use App\Models\Transaction;

class CheckoutSuccess extends NoLayout
{
    public Transaction $transaction;
    public string $paymentMethod;
    public function mount()
    {
        $this->paymentMethod = $this->transaction->destinationWallet ? 'wallet' : $this->transaction->bankAccount->bank->bank_name;
    }
    public function render()
    {
        return view('livewire.pages.checkout-success');
    }
}
