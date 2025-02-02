<?php

namespace App\Livewire;

use App\Models\Checkout;
use App\Models\Transaction;
use App\Services\CheckoutService;
use App\Services\TransactionService;
use Livewire\Attributes\Layout;
use Livewire\Component;
class Showcheckout extends Component
{
    #[Layout('components.layouts.no-layout')]
    public $referenceCode;
    public Transaction $transaction;
    private CheckoutService $checkoutService;
    private TransactionService $transactionService;
    public function boot(CheckoutService $checkoutService, TransactionService $transactionService)
    {
        $this->checkoutService = $checkoutService;
        $this->transactionService = $transactionService;
    }
    public function mount($referenceCode)
    {
        // check if transaction exists
        $transaction = $this->transactionService->checkTransaction($referenceCode);

        if (!$transaction)
            abort(404);

        $this->referenceCode = $referenceCode;
        $this->transaction = $transaction;
    }
    public function submitVerifyCode(string $otpCode)
    {
        try {

            // check if checkout exists or expired
            $checkout = $this->checkoutService->checkIfCheckoutExistsOrExpired($this->transaction);

            // check if otp is correct 
            $this->checkoutService->verifyOtpCheckout(
                $checkout,
                $otpCode
            );

            // confirm transaction and update balance in wallet
            $this->transactionService->confirmTransaction($this->transaction);

            // return redirect()->route('/checkout/success', $this->transaction->reference_code);
            $this->redirect('/withdraw', navigate: true);

        } catch (\Throwable $th) {

            $this->addError('otpCode', $th->getMessage());

        }
    }

    public function render()
    {
        return view('livewire.pages.show-checkout');
    }
}
