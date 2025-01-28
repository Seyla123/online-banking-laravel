<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
}
