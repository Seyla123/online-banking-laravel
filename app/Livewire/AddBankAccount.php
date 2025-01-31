<?php

namespace App\Livewire;

use App\Models\Bank;
use App\Services\BankAccountService;
use App\Validations\AddBankAccountValidateRules;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class AddBankAccount extends Component
{
    #[Title('បញ្ជូលគណនី')]
    public $selectedBank;
    public $bankAccountNumber;
    private BankAccountService $bankAccountService;
    public function boot(BankAccountService $bankAccountService)
    {
        $this->bankAccountService = $bankAccountService;
    }
    public function addBankAccount(): void
    {
        // validate data
        $validated = $this->validate(AddBankAccountValidateRules::rules());

        //pass data to BankAccountService
       $bankAccountCreated = $this->bankAccountService->createBankAccount($validated);
       
       // if created successfully, redirect to withdraw page
       if($bankAccountCreated){
           $this->redirect('/withdraw', navigate: true);
           return;
       }
       // if failed, redirect back to add bank account page
        $this->redirect('/add-bank-account', navigate: true);

    }
    #[On('handleDelete')]
    public function deleteBankAccount($id)
    {
        //pass data to BankAccountService
       $this->bankAccountService->deleteBankAccount($id);

    }
    public function render()
    {
        $banks = Bank::all();
        return view('livewire.pages.add-bank-account', [
            'banks' => $banks
        ]);
    }
}
