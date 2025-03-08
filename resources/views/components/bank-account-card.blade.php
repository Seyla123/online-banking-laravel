@props(['bank', 'accountNumber', 'accountName', 'bankAccountId'])
<div @click="selectedBankAccount = {{ $bankAccountId }}" x-data="{ show: false }"
    class="cursor-pointer flex justify-between gap-4 items-center  px-4 py-3 lg:py-4  border-[1px] rounded-xl min-h-[70px] xl:min-h-[100px]"
    x-bind:class="selectedBankAccount == {{ $bankAccountId }} && 'bg-[#2196F3]/15 border-[#2196F3]/15'">
    {{-- check logo  --}}
    <div class="max-w-8  rounded-lg">
        @if ($bank == 'aba')
            <img class="object-contain w-full h-full rounded-lg" src="{{ asset('asset/aba.png') }}" alt="aba bank">
        @elseif ($bank == 'wing')
            <img class="object-contain w-full h-full rounded-lg" src="{{ asset('asset/wing.png') }}" alt="wing bank">
        @elseif ($bank == 'acleda')
            <img class="object-contain w-full h-full rounded-lg" src="{{ asset('asset/acleda.jpg') }}"
                alt="acleda bank">
        @elseif ($bank == 'kess')
            <img class="object-contain w-full h-full rounded-lg" src="{{ asset('asset/kess.jpg') }}" alt="kess">
        @endif
    </div>
    {{-- info --}}
    <div class="flex flex-col justify-start w-full">
        <strong class="text-sm lg:text-md uppercase">{{ $bank }}: {{ $accountName }}</strong>
        <p class="text-sm text-gray-500">លេខគណនី​ : {{ $accountNumber }}</p>
    </div>

    {{-- delete button , when click the modal confirm delete will show--}}
    <button x-show="selectedBankAccount !== {{ $bankAccountId }}" type="button"
        @click="event.stopPropagation();show = true">
        <img class="min-w-6" src="{{ asset('asset/trash.svg') }}" alt="delete">
    </button>

    {{-- selected icon when bank account is selected --}}
    <button x-show="selectedBankAccount == {{ $bankAccountId }}"
        class=" text-sm whitespace-nowrap bg-[#2196F3]/20 hover:bg-[#2196F3]/30 font-semibold text-[#2ba0ff] p-2 rounded-full flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-check">
            <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
    </button>

    {{-- modal delete confirmation --}}
    <x-modal-confirm-delete :$bankAccountId :message="'តើអ្នកប្រាកដជាចង់លុបគណនី ' . strtoupper($bank) . ' : ' . strtoupper($accountName) . ' នេះឬទេ?'">
    </x-modal-confirm-delete>

</div>
