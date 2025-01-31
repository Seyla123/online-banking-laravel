<?php 

namespace App\Repositories;

use App\Interfaces\WalletRepositoryInterface;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class WalletRepository  implements WalletRepositoryInterface
{
    private Wallet $wallet;
    public function __construct()
    {
        $this->getWallet();
    }
    public function getWallet(): Wallet
    {
        $this->wallet = Auth::user()->wallet->first();
        return $this->wallet;
    }
    public function currentBalance(): float
    {
        return $this->wallet->balance;
    }
    public function withdraw(float $amount): void
    {
        $this->subtractAmount($amount);
    }
    public function deposit(float $amount): void
    {
        $this->addAmount($amount);
    }
    public function transfer(float $amount): void
    {
        $this->subtractAmount($amount);
    }
    private function subtractAmount(float $amount): void
    {
        $this->wallet->balance -= $amount;
        $this->wallet->save();
    }
    private function addAmount(float $amount): void
    {
        $this->wallet->balance += $amount;
        $this->wallet->save();
    }
}