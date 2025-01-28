<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function wallet()
    {
        return $this->hasMany(Wallet::class);
    }
    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }
    public function primaryBankAccount()
    {
        return $this->hasOne(PrimaryBankAccount::class);
    }
    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
