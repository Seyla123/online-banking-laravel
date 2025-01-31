<?php
namespace App\Services;

use App\Repositories\BankAccountRepository;
use Illuminate\Support\Facades\Auth;

class BankAccountService
{
    private BankAccountRepository $repository;
    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * create a new bank account
     * @param array $data the data needed to create a new bank account.
     * @return bool True on success, False on fail
     */
    public function createBankAccount(array $data): bool
    {
        try {
            $this->repository->create([
                'bank_id' => $data['selectedBank'],
                'account_number' => $data['bankAccountNumber'],
                'account_name' => Auth::user()->name,
            ]);

            session()->flash('success', 'បញ្ជូលគណនីរបស់អ្នកបានជោគជ័យ');
            return true;
        } catch (\Throwable $th) {

            if (config('app.env') == 'production') {
                session()->flash('fail', 'បរាជ័យក្នុងការបញ្ជូលគណនី');
            } else {
                session()->flash('fail', $th->getMessage());
            }
            return false;
        }
    }
    /**
     * Delete a bank account by id
     * @param int|string $id The ID of the bank account to delete.
     * @return void
     */
    public function deleteBankAccount(int|string $id): void
    {
        try {
            // find the bank account
            $bankAccount = $this->repository->find($id);
            if (!$bankAccount) {
                throw new \Exception('រកមិនឃើញគណនីនេះក្នុងប្រព័ន្ធទេ');
            }

            // delete the bank account
            $this->repository->delete($bankAccount);
            
            session()->flash('success', 'លុបគណនីរបស់អ្នកបានជោគជ័យ');

        } catch (\Throwable $th) {
            if (config('app.env') == 'production') {
                session()->flash('fail', 'បរាជ័យក្នុងការលុបគណនី');
            } else {
                session()->flash('fail', $th->getMessage());
            }
        }
    }

}

