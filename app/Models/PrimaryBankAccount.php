<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrimaryBankAccount extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
}
