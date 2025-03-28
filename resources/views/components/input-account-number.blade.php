<div
    class="flex gap-2 items-center  focus:border-indigo-500 focus:ring-indigo-500 rounded-md border-[1px] px-4 py-2 "
    x-bind:class="errors.bankAccountNumber && 'border-red-500' ">
    <img class="w-6" src="{{ asset('asset/wallet.svg') }}" alt="balance">
    <input @input="validateAccount()" type="number" x-model="bankAccountNumber" placeholder="{{ __('bank_account_number_placeholder') }}"
        class="w-full focus:outline-none  lowercase
    focus:ring-0
    border-none shadow-none" />
    <button x-show="bankAccountNumber" class="text-red-500" @click.prevent="bankAccountNumber = ''">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M 18 6 L 6 18" /><path d="M 6 6 L 18 18" /></svg>
    </button>
</div>
