<?php

namespace App\Livewire;

use App\Models\Bank;
use Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class AddBankAccount extends Component
{
    #[Title('បញ្ជូលគណនី')]
    public $selectedBank;
    public $bankAccountNumber;
    public function addBankAccount(): void
    {
        $validated = $this->validate([
            'selectedBank' => 'required',
            'bankAccountNumber' => 'required'
        ]);

        try {
            Auth::user()->bankAccounts()->create([
                'bank_id' => $validated['selectedBank'],
                'account_number' => $validated['bankAccountNumber'],
                'account_name' => Auth::user()->name

            ]);
            session()->flash('success', 'បញ្ជូលគណនីរបស់អ្នកបានជោគជ័យ');
            $this->redirect('/withdraw', navigate: true);

        } catch (\Throwable $th) {
            session()->flash('fail', 'បរាជ័យក្នុងការបញ្ជូលគណនី');
            $this->redirect('/add-bank-account', navigate: true);
        }

    }
    public function render()
    {
        $banks = Bank::all();
        return view('livewire.pages.add-bank-account', [
            'banks' => $banks
        ]);
    }
}
