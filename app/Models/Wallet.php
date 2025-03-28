<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    private static function generateWalletNumber()
    {
        do {
            $number = mt_rand(1000000000, 9999999999); // 10-digit number
        } while (self::where('wallet_number', $number)->exists());

        return $number;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($wallet) {
            // Generate unique wallet number if not provided
            if (empty($wallet->wallet_number)) {
                $wallet->wallet_number = self::generateWalletNumber();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getFormattedWalletNumberHideAttribute(): string|null
    {
        $walletNumber = $this->wallet_number;

        if (!$walletNumber) {
            return null; // Return null if no wallet number
        }

        // Ensure it's a string
        $walletNumber = strval($walletNumber);
        // Replace the middle part with '*****'
        $formattedWalletNumber = substr_replace($walletNumber, '*****', 5, 5);

        // Return formatted string
        return $formattedWalletNumber;
    }

    public function outgoingTransactions()
    {
        return $this->hasMany(Transaction::class, 'source_wallet_id');
    }

    public function incomingTransactions()
    {
        return $this->hasMany(Transaction::class, 'destination_wallet_id');
    }


}
