<?php 

namespace App\Repositories;

use App\interfaces\BankAccountRepositoryInterface;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth;

class BankAccountRepository implements BankAccountRepositoryInterface
{
    public function create($data): BankAccount
    {
        return Auth::user()->bankAccounts()->create($data);
    }
    public function delete(BankAccount $bankAccount): bool
    {
       return $bankAccount->delete();
    }
    public function find(string|int $id): ?BankAccount
    {
        return Auth::user()->bankAccounts->find($id);
    }
}