<?php 

namespace App\Interfaces;

use App\Models\BankAccount;

interface BankAccountRepositoryInterface
{
    public function create(array $data): BankAccount;
    public function find(string|int $id): ?BankAccount;
    public function delete(BankAccount $bankAccount): bool;
}
