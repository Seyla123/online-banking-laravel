<div class="relative flex items-center rounded-lg bg-white shadow-sm ring-1 ring-gray-300 hover:ring-2 hover:ring-indigo-400 transition-all duration-200"
    x-bind:class="errors.bankAccountNumber && 'ring-red-500'">
    <img class="absolute left-3 w-5 text-gray-500" src="{{ asset('asset/wallet.svg') }}" alt="balance">
    <input 
        @input="validateAccount()" 
        type="number" 
        x-model="bankAccountNumber" 
        placeholder="{{ __('bank_account_number_placeholder') }}"
        class="w-full pl-10 pr-10 py-3 border-0 focus:ring-0 focus:outline-none rounded-lg text-gray-900"
    />
    <button 
        x-show="bankAccountNumber" 
        @click.prevent="bankAccountNumber = ''" 
        class="absolute right-3 p-1 rounded-full hover:bg-gray-100 transition-colors"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x text-gray-400 hover:text-gray-600">
            <path d="M18 6L6 18"/>
            <path d="M6 6l12 12"/>
        </svg>
    </button>
</div>
