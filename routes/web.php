<?php

use App\Livewire\AddBankAccount;
use App\Livewire\CheckoutFail;
use App\Livewire\CheckoutSuccess;
use App\Livewire\Showcheckout;
use App\Livewire\Withdraw;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/withdraw', Withdraw::class)->middleware(['auth', 'verified'])
    ->name('withdraw');

Route::get('/add-bank-account', AddBankAccount::class)->middleware(['auth', 'verified'])->name('add-bank-account');

Route::get('/wallet', function () {
    return 'wallet';
})->name('wallet');

// checkout
Route::prefix('checkout')->group(function () {
    Route::get('/success/{transaction:reference_code}', CheckoutSuccess::class)->name('checkout.success');
    
    Route::get('/failed', CheckoutFail::class)->name('checkout.fail');

    Route::get('/{referenceCode}', Showcheckout::class)->name('checkout');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__ . '/auth.php';
