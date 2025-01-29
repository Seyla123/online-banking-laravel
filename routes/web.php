<?php

use App\Livewire\Withdraw;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/withdraw', Withdraw::class)->middleware(['auth', 'verified'])->name('withdraw');
Route::get('/wallet', function () {
    return 'wallet';
})->name('wallet');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__ . '/auth.php';
