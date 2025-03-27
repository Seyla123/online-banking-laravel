<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function getFormattedPhoneHideAttribute(): string|null
    {
        $number = $this->phone; // Assuming 'phone' column stores the raw number

        if (!$number) {
            return null; // Return null if no phone number
        }

        // Ensure it's a string
        $number = strval($number);
        // Extract parts based on format
        $countryCode = '+855';    // Cambodia country code
        $prefix = substr($number, 0, 2);   // First 2 digits: "17"
        $part1 = substr($number, 2, 3);    // Next 3 digits: "004"
        $part2 = '*****';                    // Mask the middle part
        $part3 = substr($number, -2);      // Last 2 digits: "79"

        // Return formatted string
        return "{$countryCode} {$prefix} {$part1} {$part2} {$part3}";
    }
    public function getFormattedEmailHideAttribute(): string|null
    {
        $email = $this->email;

        if (!$email) {
            return null; // Return null if no email
        }

        // Ensure it's a string
        $email = strval($email);
        // Extract parts based on format
        $localPart = substr($email, 0, 5);
        $domain = substr($email, strpos($email, '@') + 1);

        // Return formatted string
        return "{$localPart}*****@{$domain}";
    }
}
