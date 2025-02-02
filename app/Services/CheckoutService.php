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
                'otp_code' => '111111',
                'expired_at' => now()->addMinutes(5)
            ]
        );
    }
    public function verifyOtpCheckout(Checkout $checkout, string $otp): Checkout
    {
        if($checkout->otp_code != $otp){
            throw new \Exception('Invalid OTP code');
        }
        return $checkout;
    }
    public function checkIfCheckoutExistsOrExpired(Transaction $transaction): Checkout
    {
        if (!$transaction->checkout) {
            throw new \Exception('Checkout not found');
        }
        if ($transaction->checkout->expired_at < now()) {
            throw new \Exception('Checkout is expired');
        }

        return $transaction->checkout;
    }

    public function updateCheckout(Checkout $checkout, array $data): Checkout
    {
        return $this->repository->update($checkout, $data);
    }
}