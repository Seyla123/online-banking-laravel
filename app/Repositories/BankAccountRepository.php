<?php 

namespace App\Repositories;

use App\Models\BankAccount;

class BankAccountRepository
{
    public function create($data): BankAccount
    {
        return BankAccount::create($data);
    }
    public function delete($id)
    {
        BankAccount::destroy($id);
    }
}