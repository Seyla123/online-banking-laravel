<div class="flex gap-2 items-center  focus:border-indigo-500 focus:ring-indigo-500 rounded-md border-[1px] px-4 py-2 {{ $errors->has('amount') ? 'border-red-500' : 'border-gray-300' }}" 
     x-bind:class="errors.amount && ' border-red-500'">
    $
    <input  @input="validateAmount()" type="number" x-model="amount" wire:model="amount" placeholder="ចំនួនទឹកប្រាក់" class="w-full focus:outline-none 
    focus:ring-0
    border-none shadow-none"/>
    <button x-show="amount" class="text-red-500" @click.prevent="amount = ''">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M 18 6 L 6 18" /><path d="M 6 6 L 18 18" /></svg>
    </button>
</div>