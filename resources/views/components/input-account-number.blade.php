@props([
    'isError' => false,
])
<div
    class="flex gap-2 items-center  focus:border-indigo-500 focus:ring-indigo-500 rounded-md border-[1px] px-4 py-2 {{ $isError ? 'border-red-500' : 'border-gray-300' }}">
    <img class="w-6" src="{{ asset('asset/wallet.svg') }}" alt="balance">
    <input type="number" x-model="account" placeholder="លេខគណនីធនាគារ"
        class="w-full focus:outline-none 
    focus:ring-0
    border-none shadow-none" />
</div>
