<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ['deposit', 'withdrawal', 'transfer']); 
            $table->foreignId('source_wallet_id')->nullable()->constrained('wallets')->onDelete('cascade');
            $table->foreignId('destination_wallet_id')->nullable()->constrained('wallets')->onDelete('cascade');
            $table->foreignId('bank_account_id')->nullable()->constrained('bank_accounts')->onDelete('cascade'); 
            $table->decimal('amount', 15, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->enum('status', ['pending', 'completed', 'failed']); 
            $table->string('reference_code')->unique();
            $table->timestamps(); 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
