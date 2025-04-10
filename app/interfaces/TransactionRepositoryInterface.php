<?php 

namespace App\Interfaces;

use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function create(array $data): Transaction;
    public function find(string|int $id): Transaction;

}