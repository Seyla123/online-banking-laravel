<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Checkout;
use App\Models\PrimaryBankAccount;
use App\Models\Transaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);



        // create banks 
        $banks = [
            'aba',
            'wing',
            'acleda',
            'kess'
        ];
        foreach ($banks as $bank)
        {
            Bank::factory()->create([
                'bank_name'=>$bank
            ]);
        }
        // Create Bank account
        User::factory()->count(2)
            ->has(
                BankAccount::factory()
                ->count(4)
            )
            ->has(
                PrimaryBankAccount::factory(1)->state(function (array $attributes, User $user) {
                    return [
                        'user_id' => $user->id,
                        'bank_account_id' => BankAccount::where('user_id', $user->id)->get()->random()->id,
                    ];
                })
            )
            ->has(
                Wallet::factory()->count(2)
            )
            ->create();

            // create 10
            Transaction::factory()->count(10)
                        ->has(
                            Checkout::factory()->count(1)
                        )
                        ->create();

            // User::factory()->count(2)
            // ->has(
            //     Car::factory()
            //         ->count(50)
            //         ->has(CarImage::factory()
            //             ->count(5)
            //             ->sequence(fn(Sequence $sequence) =>
            //                 ['position' => $sequence->index % 5 + 1]), 'images')
            //         ->hasFeatures(),
            //     'favouriteCars'
            // )
            // ->create();
    }
}
