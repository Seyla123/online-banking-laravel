<?php

namespace App\Livewire;

use App\Models\Transaction;
use App\Services\CheckoutService;
use App\Services\TransactionService;

class Checkout extends NoLayout
{
    public $referenceCode;
    public Transaction $transaction;
    private CheckoutService $checkoutService;
    private TransactionService $transactionService;
    public function boot(CheckoutService $checkoutService, TransactionService $transactionService)
    {
        $this->checkoutService = $checkoutService;
        $this->transactionService = $transactionService;
    }
    public function mount()
    {
        try {
            
            // check if transaction exists and check if checkout exists or expired
            $transaction = $this->transactionService->checkTransaction($this->referenceCode);

            $this->transaction = $transaction;

        } catch (\Throwable $th) {

            $this->redirectRoute('checkout.fail', navigate: true);

        }
    }
    public function submitVerifyCode(string $otpCode)
    {
        try {
            // Verify Otp
            $this->checkoutService->verifyOtpCheckout(
                $this->transaction->checkout,
                $otpCode
            );

            // confirm transaction
            $this->transactionService->confirmTransaction($this->transaction);

            // redirect to checkout success
            $this->redirect(route('checkout.success', [
                'transaction' => $this->transaction
            ]), navigate: true);


        } catch (\Throwable $th) {

            $this->addError('otpCode', $th->getMessage());

        }
    }
    public function resendOtpCode()
    {
        dd('clicked resend otp');
    }
    public function render()
    {
        return view('livewire.pages.checkout');
    }
}
