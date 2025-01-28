<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }
}
