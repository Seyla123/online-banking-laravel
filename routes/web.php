<?php

use App\Livewire\AddBankAccount;
use App\Livewire\CheckoutFail;
use App\Livewire\CheckoutSuccess;
use App\Livewire\Checkout;
use App\Livewire\SendOtpOption;
use App\Livewire\Wallet;
use App\Livewire\Withdraw;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::view('/', 'welcome');

Route::get('/withdraw', Withdraw::class)->middleware(['auth', 'verified'])
    ->name('withdraw');
Route::get('/wallet', Wallet::class)->middleware(['auth', 'verified'])->name('wallet');
Route::get('/add-bank-account', AddBankAccount::class)->middleware(['auth', 'verified'])->name('add-bank-account');

// send otp options
Route::get('send-otp-option/{transaction:reference_code}', SendOtpOption::class)->middleware(['auth', 'verified'])->name('send-otp-option');

// checkout
Route::prefix('checkout')->group(function () {

    Route::get('/success/{transaction:reference_code}', CheckoutSuccess::class)
        ->name('checkout.success');

    Route::get('/failed', CheckoutFail::class)->name('checkout.fail');

    Route::get('/{referenceCode}', Checkout::class)->name('checkout');
});

// language
Route::get('language/{locale}', function ($locale) {

    if (!in_array($locale, ['en', 'kh'])) {
        abort(400);
    }

    session()->put('locale', $locale);
    return redirect()->back();
})->name('local');


// profile
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__ . '/auth.php';
