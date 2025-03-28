<?php

namespace App\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Wallet as WalletModel;

class Wallet extends Component
{
    #[Title('កាបូប')]
    public WalletModel $wallet;
    public $perPage = 1;
    public $hasMorePages = true;

    public function mount()
    {
        $this->wallet = Auth::user()->wallet->first();
    }

    public function loadMore()
    {
        // Add fake loading delay
        sleep(1);
        
        $this->perPage += 1;
    }

    public function render()
    {
        $transactions = $this->wallet->outgoingTransactions()
            ->orderBy('created_at', 'desc')
            ->take($this->perPage)
            ->get();

        $this->hasMorePages = count($transactions) === $this->perPage;

        return view('livewire.pages.wallet', [
            'transactions' => $transactions
        ]);
    }
}
