<?php 

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function create(array $data): Transaction
    {
        return Auth::user()->transactions()->create($data);
    }
    public function find(string|int $id): Transaction
    {
        return Transaction::findOrFail($id);
    }
    
}