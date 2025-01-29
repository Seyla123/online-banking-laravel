<div class="max-w-2xl mx-auto space-y-4">
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
    <x-alert-verify-phone :phone="$user->phone" :verified="$user->otp_verified_at"/>
    {{-- input withdraw amount --}}
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            សូមកំណត់ចំនួនទឹកប្រាក់ ៖​
        </h2>
        <div x-data="{
            amount: '',
            addAmount($input) {
                if (this.amount == '') {
                    this.amount = parseInt(0);
                }
                this.amount = parseInt(this.amount) + parseInt($input);
            }
        }" class="space-y-2">
            <x-input-amount x-model.number="amount" :isError="false" />
            {{-- <x-input-error :messages="'សូមបញ្ជូលចំនួនទឹកប្រាក់ជាមុនសិន !'" class="mt-2" /> --}}
            {{-- key amount input --}}
            <div class="grid grid-cols-4 gap-1" x-data="{ keysInput: [5, 10, 20, 50, 100, 200, 300, 500] }">
                <template x-for="key in keysInput">
                    <button @click="addAmount(key)" x-text="'$' + key"
                        class="w-full bg-gray-200 text-sm rounded-md py-3"></button>
                </template>
            </div>
        </div>
    </section>
    {{-- bank account --}}
    <section class="space-y-2">
        <div class="flex justify-between">
            <h2 class="font-semibold text-gray-800 leading-tight">
                ជ្រើសរើសគណនីធនាគារដកប្រាក់ ៖​
            </h2>
            <a wire:navigate href="{{ route('add-bank-account') }}"
                class="flex gap-1 items-center transition-transform duration-300 transform hover:scale-105">
                <h2 class="font-semibold text-gray-800 leading-tight">
                    បន្ថែមគណនី
                </h2>
                <img class="min-w-5" src="{{ asset('asset/add.svg') }}" alt="edit">
            </a>
        </div>
        <div class="space-y-1 lg:space-y-2" x-data="{selectedBankAccount:@js($primaryBankAccount->bank_account_id)}">
            @foreach ($bankAccounts as $bankAccount)
                <x-bank-account-card :isSelected="false" :accountName="$bankAccount->account_name" :accountNumber="$bankAccount->account_number" :bank="$bankAccount->bank->bank_name"
                :bankAccountId="$bankAccount->id" />
            @endforeach
        </div>
    </section>

    <div class="flex w-full justify-center pb-4 sticky bottom-0">
        <x-primary-button class="w-full flex justify-center py-4">ដកប្រាក់</x-primary-button>
    </div>

</div>
