<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Checkout;
class Showcheckout extends Component
{
    public Checkout $checkout;
    public $referenceCode;
    public function mount($referenceCode)
    {
        $this->referenceCode = $referenceCode;
    }
    public function render()
    {
        return view('livewire.pages.checkout');
    }
}
