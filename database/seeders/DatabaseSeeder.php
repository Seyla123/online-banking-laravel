<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Checkout;
use App\Models\PrimaryBankAccount;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        $users = User::factory(3)->create();

        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create banks
        $banks = ['aba', 'wing', 'acleda', 'kess'];
        foreach ($banks as $bank) {
            Bank::factory()->create(['bank_name' => $bank]);
        }

        // Create Bank Accounts and Wallets for each user
        foreach ($users as $user) {
            // Create bank accounts
            $bankAccounts = BankAccount::factory()->count(4)->create([
                'user_id' => $user->id,
            ]);

            // Assign a primary bank account
            PrimaryBankAccount::factory()->create([
                'user_id' => $user->id,
                'bank_account_id' => $bankAccounts->random()->id, // Randomly select a bank account
            ]);

            // Create wallets
            Wallet::factory()->count(2)->create([
                'user_id' => $user->id,
            ]);
        }

        // Create Transactions with Checkouts
        Transaction::factory()
            ->count(10)
            ->has(Checkout::factory()->count(1))
            ->create();
    }
}
