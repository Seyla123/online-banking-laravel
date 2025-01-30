<?php
namespace App\Services;

use App\Models\Article;
use App\Repositories\BankAccountRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BankAccountService extends Component
{
    private BankAccountRepository $repository;
    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createBankAccount(array $data): bool
    {
        try {
            $this->repository->create([
                'bank_id' => $data['selectedBank'],
                'account_number' => $data['bankAccountNumber'],
                'account_name' => Auth::user()->name,
                'user_id' => Auth::user()->id
            ]);
            session()->flash('success', 'បញ្ជូលគណនីរបស់អ្នកបានជោគជ័យ');
            return true;
        } catch (\Throwable $th) {
            session()->flash('fail', 'បរាជ័យក្នុងការបញ្ជូលគណនី');
            return false;
        }
    }
    public function deleteBankAccount($id)
    {
        try {
            $this->repository->delete($id);
            session()->flash('success', 'លុបគណនីរបស់អ្នកបានជោគជ័យ');
            return;
        } catch (\Throwable $th) {
            session()->flash('fail', $th->getMessage());
        }
    }

}

