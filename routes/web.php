<?php

use App\Livewire\AddBankAccount;
use App\Livewire\Withdraw;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/withdraw', Withdraw::class)->middleware(['auth', 'verified'])
->name('withdraw');

Route::get('/add-bank-account', AddBankAccount::class)->middleware(['auth', 'verified'])->name('add-bank-account');
Route::get('/wallet', function () {
    return 'wallet';
})->name('wallet');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__ . '/auth.php';
