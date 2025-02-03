<?php

namespace App\Livewire;

use App\Livewire\NoLayout;
use App\Models\Transaction;

class CheckoutSuccess extends NoLayout
{
    public Transaction $transaction;
    public function render()
    {
        return view('livewire.pages.checkout-success');
    }
}
