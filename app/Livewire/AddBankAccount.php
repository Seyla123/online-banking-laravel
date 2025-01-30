<?php

namespace App\Livewire;

use App\Models\Bank;
use Livewire\Attributes\Title;
use Livewire\Component;

class AddBankAccount extends Component
{
    #[Title('បញ្ជូលគណនី')]
    public $showError = false;
    public $showSuccess = false;
    public function render()
    {
        $banks = Bank::all();
        dump($banks);
        return view('livewire.pages.add-bank-account', [
            'banks' => $banks
        ]);
    }
}
