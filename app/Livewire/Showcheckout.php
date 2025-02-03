<?php

namespace App\Livewire;

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
        $this->referenceCode = $referenceCode;
        
        try {
            
            // check if transaction exists and check if checkout exists or expired
            $transaction = $this->transactionService->checkTransaction($this->referenceCode);

            $this->transaction = $transaction;

        } catch (\Throwable $th) {

            $this->redirect('/withdraw', navigate: true);

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

            // return redirect()->route('/checkout/success', $this->transaction->reference_code);
            $this->redirectRoute('withdraw', navigate: true);

        } catch (\Throwable $th) {

            $this->addError('otpCode', $th->getMessage());

        }
    }

    public function render()
    {
        return view('livewire.pages.show-checkout');
    }
}
