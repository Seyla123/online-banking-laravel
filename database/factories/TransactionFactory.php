<?php

namespace Database\Factories;

use App\Models\BankAccount;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sourceWallet = Wallet::inRandomOrder()->first();
        $user = $sourceWallet->user;

        return [
            'transaction_type' => $this->faker->randomElement(['deposit', 'withdrawal', 'transfer']),
            'amount' => $this->faker->randomFloat(2, 10, 1000), // Random amount
            'user_id' => $user->id,
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'reference_code' => $this->faker->unique()->uuid,
            'source_wallet_id' => $sourceWallet->id,
            'destination_wallet_id' => function (array $attributes) {
                if ($attributes['transaction_type'] === 'transfer') {
                    return Wallet::inRandomOrder()->first()->id;
                }
            },
            'bank_account_id' => function (array $attributes) use ($user) {
                if ($attributes['transaction_type'] === 'deposit' || $attributes['transaction_type'] === 'withdrawal') {
                    return $user->bankAccounts()->inRandomOrder()->first()?->id;
                }
            },
        ];
    }

}
