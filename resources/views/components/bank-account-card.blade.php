@props([
    'isSelected' => false,
    'bank',
    'accountNumber',
    'accountName',
])
<div
    class="flex justify-between gap-4 items-center  px-4 py-3 lg:py-4  border-[1px] rounded-xl {{ $isSelected ? 'bg-[#2196F3]/15 border-[#2196F3]/15' : '' }} ">
    {{-- logo --}}
    <div class="min-w-8">
        <img class="object-contain w-full h-full" src="{{ asset('asset/aba.png') }}" alt="bank">
    </div>
    {{-- info --}}
    <div class="flex flex-col justify-start w-full">
        <strong class="text-sm lg:text-md uppercase">{{ $bank }}: {{ $accountName }}</strong>
        <p class="text-sm text-gray-500">លេខគណនី​ : {{ $accountNumber }}</p>
    </div>
    {{-- delete button --}}
    <button>
        <img class="min-w-6" src="{{ asset('asset/trash.svg') }}" alt="delete">
    </button>
</div>
