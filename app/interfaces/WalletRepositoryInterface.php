<?php 

namespace App\Interfaces;

interface WalletRepositoryInterface
{
    public function currentBalance(): float;
    public function withdraw(float $amount);
    public function deposit(float $amount);
    public function transfer(float $amount);
}