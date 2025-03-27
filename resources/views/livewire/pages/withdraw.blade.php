<div class="max-w-2xl mx-auto space-y-6" x-data="{
    amount: $wire.amount == 0 ? '' : $wire.amount,
    selectedBankAccount: @js($primaryBankAccount),
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
            $wire.set('amount', this.amount);
            $wire.set('selectedBankAccount', this.selectedBankAccount);
            $wire.save();
        }
    }
}">
    {{-- header title --}}
    <x-slot name="header">
        ដកប្រាក់
    </x-slot>

    {{-- wallet section --}}
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            កាបូបរបស់អ្នក ៖​
        </h2>
        <x-wallet-card :walletNumber="$wallet->wallet_number" :balance="$wallet->balance" />
    </section>
    {{-- verify phone --}}
    <x-alert-verify-phone :phone="auth()->user()->phone" />

    {{-- input withdraw amount section --}}
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            សូមកំណត់ចំនួនទឹកប្រាក់ ៖​
        </h2>
        <div class="space-y-2">
            <x-input-amount x-model.number="amount" wire:model.number="amount" x-bind:input="validateAmount()" />
            <!-- Alpine Error Message -->
            <p x-show="errors.amount" x-text="errors.amount" class="text-red-500 text-sm mt-2">
            </p>
            @error('amount')
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            @enderror
            {{-- key amount input --}}
            <div class="grid grid-cols-4 gap-1" x-data="{ keysInput: [5, 10, 20, 50, 100, 200, 300, 500] }">
                <template x-for="key in keysInput">
                    <button type="button" x-on:click="addAmount(key)" x-key="key" x-text="'$' + key"
                        class="w-full bg-gray-200 text-sm rounded-md py-3">
                    </button>
                </template>
            </div>
        </div>
    </section>

    {{-- bank account section --}}
    <section class="space-y-2">
        <div class="flex justify-between">
            <h2 class="font-semibold text-gray-800 leading-tight">
                ជ្រើសរើសគណនីធនាគារដកប្រាក់ ៖​
            </h2>
            {{-- click to add bank account --}}
            <a wire:navigate href="{{ route('add-bank-account') }}"
                class="flex gap-1 items-center transition-transform duration-300 transform hover:scale-105">
                <h2 class="font-semibold text-gray-800 leading-tight">
                    បន្ថែមគណនី
                </h2>
                <img class="min-w-5" src="{{ asset('asset/add.svg') }}" alt="edit">
            </a>
        </div>
        <div class="space-y-1 lg:space-y-2">
            @forelse ($bankAccounts as $bankAccount)
                <x-bank-account-card :accountName="$bankAccount->account_name" :accountNumber="$bankAccount->account_number" :bank="$bankAccount->bank->bank_name" :bankAccountId="$bankAccount->id"
                    @click="selectBankAccount({{ $bankAccount->id }})" wire:key="{{ $bankAccount->id }}" />
            @empty
                <div class="min-h-[150px] flex items-center justify-center bg-gray-100 rounded-lg shadow-md p-4">
                    <div class="flex flex-col items-center gap-2">
                        <p class="text-center text-gray-600 text-lg font-semibold">គ្មានគណនី</p>

                    </div>
                </div>
            @endforelse
            <!-- Alpine Error Message -->
            <p x-show="errors.bankAccount" x-text="errors.bankAccount" class="text-red-500 text-sm mt-2">
            </p>
        </div>
    </section>

    {{-- submit button --}}
    <div class="flex w-full justify-center pb-4 sticky bottom-0">
        <x-primary-button type="button" @click="submitForm" class="w-full flex justify-center py-4">
            <span wire:loading.remove>ដកប្រាក់</span>
            <span wire:loading>កំពុងដំណើរការ...</span>
        </x-primary-button>
    </div>

    {{-- Success & Error Messages --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }">
            <x-modal-success :message="session('success')" />
        </div>
    @endif
    @if (session()->has('fail'))
        <div x-data="{ show: true }">
            <x-modal-error :message="session('fail')" />
        </div>
    @endif
    </form>
