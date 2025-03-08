<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'transaction_type',
        'source_wallet_id',
        'destination_wallet_id',
        'reference_code',
        'bank_account_id',
        'status'
    ];
    
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
    public function checkout(): HasOne
    {
        return $this->hasOne(Checkout::class);
    }
}
