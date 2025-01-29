<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Withdraw extends Component
{
    #[Title('ដកប្រាក់')]
    public $balance = 26490;
    public $walletNumber = '123142343214';
    public $phone = '962059095';
    public function render()
    {
        return view('livewire.pages.withdraw');
    }
}
