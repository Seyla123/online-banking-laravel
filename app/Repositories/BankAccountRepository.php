<?php 

namespace App\Repositories;

use App\interfaces\BankAccountRepositoryInterface;
use App\Models\BankAccount;

class BankAccountRepository implements BankAccountRepositoryInterface
{
    public function create($data): BankAccount
    {
        return BankAccount::create($data);
    }
    public function delete(BankAccount $bankAccount): bool
    {
       return $bankAccount->delete();
    }
    public function find(string|int $id): ?BankAccount
    {
        return BankAccount::find($id)->first();
    }
}