<?php 

namespace App\Services;

use App\Models\Checkout;
use App\Models\Transaction;
use App\Repositories\CheckoutRepository;

class CheckoutService 
{
    private CheckoutRepository $repository;
    public function __construct(CheckoutRepository $repository)
    {
        $this->repository = $repository;
    }
    public function createCheckout(Transaction $transaction): Checkout
    {
        return $this->repository->create(
            [
                'transaction_id' => $transaction->id,
                'otp_code' => '5555'
            ]
        );
    }
    public function verifyOtpCheckout(Checkout $checkout, string $otp): Checkout
    {
        dd($checkout, $otp);
        return $checkout;
    }
}