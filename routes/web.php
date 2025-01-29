<?php

use App\Livewire\Wallet;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/wallet', Wallet::class)->middleware(['auth', 'verified'])->name('wallet');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__ . '/auth.php';
