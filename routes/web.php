<?php

use App\Livewire\AddBankAccount;
use App\Livewire\CheckoutFail;
use App\Livewire\CheckoutSuccess;
use App\Livewire\Checkout;
use App\Livewire\SendOtpOption;
use App\Livewire\Withdraw;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::get('/withdraw', Withdraw::class)->middleware(['auth', 'verified'])
    ->name('withdraw');

Route::get('/add-bank-account', AddBankAccount::class)->middleware(['auth', 'verified'])->name('add-bank-account');

Route::get('/wallet', function () {
    return 'wallet';
})->name('wallet');

// send otp options
Route::get('send-otp-option/{transaction:reference_code}', SendOtpOption::class)->middleware(['auth', 'verified'])->name('send-otp-option');

// checkout
Route::prefix('checkout')->group(function () {

    Route::get('/success/{transaction:reference_code}', CheckoutSuccess::class)
    ->name('checkout.success');
    
    Route::get('/failed', CheckoutFail::class)->name('checkout.fail');

    Route::get('/{referenceCode}', Checkout::class)->name('checkout');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__ . '/auth.php';
