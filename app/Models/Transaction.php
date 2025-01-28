<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    
    public function sourceWallet()
    {
        return $this->belongsTo(Wallet::class, 'source_wallet_id');
    }

    public function destinationWallet()
    {
        return $this->belongsTo(Wallet::class, 'destination_wallet_id');
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
