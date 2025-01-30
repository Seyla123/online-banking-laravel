<div class="max-w-2xl mx-auto space-y-4" x-data="{
    bankAccountNumber: '',
    selectedBank: @js($banks[0]->id),
    errors: {
        bankAccountNumber: '',
        selectedBank: ''
    },
    validateAccount() {
        if (this.bankAccountNumber == '') {
            this.errors.bankAccountNumber = 'សូមបញ្ជូលលេខគណនីជាមុនសិន !';
            return false;
        }

        this.errors.bankAccountNumber = '';
        return true;
    },
    submitForm() {
        if(this.validateAccount()) {
            $wire.set('bankAccountNumber', this.bankAccountNumber);
            $wire.set('selectedBank', this.selectedBank);
            $wire.addBankAccount();
        }
    },

}">
    {{-- header title --}}
    <x-slot name="header">
        បញ្ជូលគណនី
    </x-slot>
    {{-- Banks --}}
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            សូមជ្រើសរើសធនាគារ ៖​
        </h2>
        <div class="grid grid-cols-2 gap-2">
            @foreach ($banks as $bank)
                <x-bank-card :bank="$bank->bank_name" :bankId="$bank->id" wire:key="{{ $bank->id }}-banks" />
            @endforeach
        </div>
    </section>
    {{-- bank account input  --}}
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            សូមបញ្ជូលលេខគណនី ៖
        </h2>
        <div class="space-y-2"">
            <x-input-account-number x-model="bankAccountNumber" />
            <!-- Alpine Error Message -->
            <p x-show="errors.bankAccountNumber" x-text="errors.bankAccountNumber" class="text-red-500 text-sm mt-2">
            </p>
            @error('bankAccountNumber')
                <x-input-error :messages="$errors->get('bankAccountNumber')" class="mt-2" />
            @enderror
        </div>
    </section>
    {{-- button submit --}}
    <div class="fixed bottom-0 left-0 right-0 p-4 max-w-2xl mx-auto">
        <x-primary-button type="button" @click="submitForm" class="z-10 w-full flex justify-center py-4">
            <span wire:loading.remove>រក្សារទុក</span>
            <span wire:loading>កំពុងដំណើរការ...</span>
        </x-primary-button>
    </div>
    {{-- Success & Error Messages from Livewire Flash Session --}}
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
</div>
