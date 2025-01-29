<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class AddBankAccount extends Component
{
    #[Title('បញ្ជូលគណនី')]
    public function render()
    {
        return view('livewire.pages.add-bank-account');
    }
}
