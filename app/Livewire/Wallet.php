<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Wallet extends Component
{
    #[Title('កាបូប')]
    public function render()
    {
        return view('livewire.pages.wallet');
    }
}
