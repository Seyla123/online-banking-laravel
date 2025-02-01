<?php 

namespace App\Repositories;

use App\Interfaces\CheckoutRepositoryInterface;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    public function create(array $data): Checkout
    {
        return Auth::user()->checkouts()->create($data);
    }
}