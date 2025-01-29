<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Wallet extends Component
{
    #[Title('ដកប្រាក់')]
    public function render()
    {
        return view('livewire.pages.wallet');
    }
}
