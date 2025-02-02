<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
class Showcheckout extends Component
{
    #[Layout('components.layouts.no-layout')]
    public $referenceCode;
    public function mount($referenceCode)
    {
        $this->referenceCode = $referenceCode;
    }
    public function render()
    {
        return view('livewire.pages.show-checkout');
    }
}
