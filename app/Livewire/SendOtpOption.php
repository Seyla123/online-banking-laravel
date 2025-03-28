<?php

namespace App\Livewire;

use App\Models\Transaction;
use App\Services\CheckoutService;


class SendOtpOption extends NoLayout
{
    public Transaction $transaction;
    private CheckoutService $checkoutService;
    public function boot(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }
    public function submitSendOtpOption(string $option)
    {
        try {
            // TODO: send otp to email or phone to user

            // create checkout
            $this->checkoutService->createCheckout($this->transaction);

            // redirect to verify otp checkout
            return $this->redirect(route('checkout', [
                'referenceCode' => $this->transaction->reference_code
            ]), navigate: true);

        } catch (\Throwable $th) {
            // Log the error for debugging purposes
            \Log::error('Checkout creation failed: ' . $th->getMessage());
            session()->flash('fail', $th->getMessage());
        }
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
