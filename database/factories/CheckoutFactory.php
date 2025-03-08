<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Checkout>
 */
class CheckoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transaction = Transaction::inRandomOrder()->first(); 
        $user = $transaction->user;
        return [
            'transaction_id' => $transaction->id,
            'user_id' => $user->id,
            'otp_code' => $this->faker->unique()->numerify('##########'),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
        ];
    }
}
