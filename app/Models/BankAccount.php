<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BankAccount extends Model
{
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function primaryBankAccount(): HasOne
    {
        return $this->hasOne(PrimaryBankAccount::class);
    }
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
    

}
