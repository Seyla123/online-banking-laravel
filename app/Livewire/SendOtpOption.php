<?php

namespace App\Livewire;

use App\Models\Transaction;


class SendOtpOption extends NoLayout
{
    public Transaction $transaction;
    public function submitSendOtpOption(string $option)
    {
        dd('clicked', $option);
    }
    public function render()
    {
        $accountNumber = substr_replace($this->transaction->account_number, '******', 3, -3);
        // dd($this->transaction, $accountNumber);
        return view('livewire.pages.send-otp-option');
    }
}
