<?php

namespace App\Livewire;

use App\Models\Transaction;
use App\Models\Checkout as CheckoutModel;
use App\Services\CheckoutService;
use App\Services\TransactionService;

class Checkout extends NoLayout
{
    public $referenceCode;
    public Transaction $transaction;
    public CheckoutModel $checkout;
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
            // check if transaction exists
            $transaction = $this->transactionService->checkTransaction($this->referenceCode);

            // check if checkout exists or expired
            $checkout = $this->checkoutService->checkIfCheckoutExistsOrExpired($transaction);
            
            $this->transaction = $transaction;
            $this->checkout = $checkout;

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
        $phone = $this->transaction->sourceWallet->user->formatted_phone_hide;
        return view('livewire.pages.checkout',[
            'phone' => $phone
        ]);
    }
}
