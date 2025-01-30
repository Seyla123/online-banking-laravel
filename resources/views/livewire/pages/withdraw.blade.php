<form wire:submit.prevent="save" class="max-w-2xl mx-auto space-y-4" x-data="{
    amount: '',
    selectedBankAccount: @js($primaryBankAccount->bank_account_id),
    errors: {
        amount: '',
        bankAccount: ''
    },
    addAmount($input) {
        if (this.amount == '') {
            this.amount = parseInt(0);
        }
        this.amount = parseInt(this.amount) + parseInt($input);

        this.validateAmount();
    },
    selectBankAccount($bankAccountId) {
        this.selectedBankAccount = $bankAccountId;

        this.validateBankAccount();
    },
    validateAmount() {
        if (!this.amount || this.amount == 0) {
            this.errors.amount = 'សូមបញ្ជូលចំនួនទឹកប្រាក់ជាមុនសិន !';
            return false;
        }
        if (this.amount > @js($wallet->balance)) {
            this.errors.amount = 'ទឹកប្រាក់មិនគ្រប់គ្រាន់';
            return false;
        }
        this.errors.amount = '';
        return true;
    },
    validateBankAccount() {
        if (!this.selectedBankAccount) {
            this.errors.bankAccount = 'សូមជ្រើសរើសគណនីធនាគារ';
            return false;
        }
        this.errors.bankAccount = '';
        return true;
    },
    validate() {
        const isAmountValid = this.validateAmount();
        const isBankValid = this.validateBankAccount();
        return isAmountValid && isBankValid;
    },
    submitForm() {
        if (this.validate()) {
            // Send both values to Livewire
            $wire.save({
                amount: this.amount,
                bankAccountId: this.selectedBankAccount
            });
        }
    }
}">
    {{-- header title --}}
    <x-slot name="header">
        ដកប្រាក់
    </x-slot>
    {{-- Success & Error Messages from Livewire Flash Session --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-transition
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <strong class="font-bold">Success!</strong>
            <span>{{ session('success') }}</span>
            <button @click.prevent="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">×</button>
        </div>
    @endif
    {{-- wallet section --}}
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            កាបូបរបស់អ្នក ៖​
        </h2>
        <x-wallet-card :walletNumber="$wallet->wallet_number" :balance="$wallet->balance" />
    </section>
    {{-- verify phone --}}
    <x-alert-verify-phone :phone="$user->phone" />

    {{-- input withdraw amount --}}
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            សូមកំណត់ចំនួនទឹកប្រាក់ ៖​
        </h2>
        <div class="space-y-2">
            <x-input-amount x-model.number="amount" wire:model.number="amount" x-bind:input="validateAmount()" />
            @error('amount')
                <x-input-error :messages="$message" class="mt-2" />
            @enderror
            <!-- Alpine Error Message -->
            <p x-show="errors.amount" x-text="errors.amount" class="text-red-500 text-sm mt-2">
            </p>
            {{-- key amount input --}}
            <div class="grid grid-cols-4 gap-1" x-data="{ keysInput: [5, 10, 20, 50, 100, 200, 300, 500] }">
                <template x-for="key in keysInput">
                    <button type="button" x-on:click="addAmount(key)" x-text="'$' + key"
                        class="w-full bg-gray-200 text-sm rounded-md py-3">
                    </button>
                </template>
            </div>
        </div>
    </section>

    {{-- bank account --}}
    <section class="space-y-2">
        <!-- Your existing bank account header... -->
        <div class="space-y-1 lg:space-y-2">
            @foreach ($bankAccounts as $bankAccount)
                <x-bank-account-card :accountName="$bankAccount->account_name" :accountNumber="$bankAccount->account_number" :bank="$bankAccount->bank->bank_name" :bankAccountId="$bankAccount->id"
                    @click="selectBankAccount({{ $bankAccount->id }})" />
            @endforeach
            <!-- Alpine Error Message -->
            <p x-show="errors.bankAccount" x-text="errors.bankAccount" class="text-red-500 text-sm mt-2">
            </p>
        </div>
    </section>

    <div class="flex w-full justify-center pb-4 sticky bottom-0">
        <x-primary-button type="button" @click="submitForm"  class="w-full flex justify-center py-4">
            <span wire:loading.remove>ដកប្រាក់</span>
            <span wire:loading>កំពុងដំណើរការ...</span>
        </x-primary-button>
    </div>
</form>
