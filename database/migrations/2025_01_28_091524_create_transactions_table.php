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
            $table->uuid('id')->primary();
            $table->enum('transaction_type', ['deposit', 'withdrawal', 'transfer']);
            $table->unsignedBigInteger('source_wallet_id')->nullable();
            $table->unsignedBigInteger('destination_wallet_id')->nullable();
            $table->foreignId('bank_account_id')->nullable()->constrained();
            $table->decimal('amount', 15, 2);
            $table->foreignId('user_id')->constrained();
            $table->enum('status', ['pending', 'completed', 'failed']);
            $table->string('reference_code')->unique();
            $table->timestamps();

            $table->foreign('source_wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->foreign('destination_wallet_id')->references('id')->on('wallets')->onDelete('cascade');
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
