<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\Repositories\TransactionRepository;
use App\Repositories\WalletRepository;
use App\Services\CheckoutService;
use App\Services\Transactions\DepositTransaction;
use App\Services\Transactions\TransferTransaction;
use App\Services\Transactions\WithdrawTransaction;
use App\Services\TransactionService;
use App\Services\WalletService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(WalletRepository::class, function ($app) {
            return new WalletRepository();
        });

        $this->app->singleton(WalletService::class, function ($app) {
            return new WalletService($app->make(WalletRepository::class));
        });

        $this->app->singleton(TransactionRepository::class, function ($app) {
            return new TransactionRepository();
        });

        $this->app->singleton(TransactionService::class, function ($app) {
            return new TransactionService(
                $app->make(TransactionRepository::class),
                $app->make(WalletService::class),
                $app->make(DepositTransaction::class),
                $app->make(WithdrawTransaction::class),
                $app->make(TransferTransaction::class),
                $app->make(CheckoutService::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            UserRegistered::class,
        );
    }
}
