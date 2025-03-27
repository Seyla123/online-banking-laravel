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
        //Or you can call getFormattedWalletNumberHideAttribute(), getFormattedPhoneHideAttribute(), getFormattedEmailHideAttribute()
        $walletNumber = $this->transaction->sourceWallet->formatted_wallet_number_hide;
        $phone = $this->transaction->sourceWallet->user->formatted_phone_hide;
        $email = $this->transaction->sourceWallet->user->formatted_email_hide;

        // dd($walletNumber);//2398759853
        return view('livewire.pages.send-otp-option', [
            'walletNumber' => $walletNumber,
            'amount' => $this->transaction->amount,
            'email' => $email,
            'phone' => $phone
        ]);
    }
}
