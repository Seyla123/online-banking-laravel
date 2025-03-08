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
    /**
     * create checkout for confirm transaction
     * @param \App\Models\Transaction $transaction
     * @return Checkout
     */
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
    /**
     * verify otp checkout 
     * @param \App\Models\Checkout $checkout
     * @param string $otp
     * @throws \Exception
     * @return Checkout
     */
    public function verifyOtpCheckout(Checkout $checkout, string $otp): Checkout
    {
        if ($checkout->otp_code != $otp) {
            throw new \Exception('លេខកូដ OTP មិនត្រឹមត្រូវ');
        }
        return $checkout;
    }
    /**
     * check if checkout exists or expired
     * @param \App\Models\Transaction $transaction
     * @throws \Exception
     * @return \App\Models\Checkout
     */
    public function checkIfCheckoutExistsOrExpired(Transaction $transaction): Checkout
    {
        if (!$transaction->checkout) {
            throw new \Exception('រកមិនឃើញ Checkout មួយនេះទេ');
        }
        if ($transaction->checkout->status !== 'pending') {
            throw new \Exception('Checkout ត្រូវបានប្រើរួចហើយ');
        }
        if ($transaction->checkout->expired_at < now()) {
            throw new \Exception('Checkout ត្រូវបានផុតកំណត់');
        }

        return $transaction->checkout;
    }
    /**
     * confirmCheckout , atfer confirm transaction update checkout status and set otp_code to null
     * @param \App\Models\Checkout $checkout
     * @return bool
     */
    public function confirmCheckout(Checkout $checkout)
    {
        return $this->repository->update($checkout, [
            'status' => 'completed',
            'otp_code' => null
        ]);
    }
}