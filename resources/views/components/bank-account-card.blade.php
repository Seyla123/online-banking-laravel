@props(['bank', 'accountNumber', 'accountName', 'bankAccountId'])

<div 
    @click="selectedBankAccount = {{ $bankAccountId }}"
    x-data="{ show: false }"
    class="cursor-pointer group flex items-center gap-3 p-3 border rounded-lg transition-all duration-200"
    :class="{
        'bg-blue-50 border-blue-400 shadow-md': selectedBankAccount == {{ $bankAccountId }},
        'bg-white border-gray-200 hover:border-gray-300': selectedBankAccount !== {{ $bankAccountId }}
    }"
>
    <!-- Bank Logo -->
    <div class="shrink-0 w-10 h-10 rounded-md bg-gray-100 flex items-center justify-center p-1">
        @if ($bank == 'aba')
            <img class="w-full h-full object-contain" src="{{ asset('asset/aba.png') }}" alt="ABA Bank">
        @elseif ($bank == 'wing')
            <img class="w-full h-full object-contain" src="{{ asset('asset/wing.png') }}" alt="Wing Bank">
        @elseif ($bank == 'acleda')
            <img class="w-full h-full object-contain" src="{{ asset('asset/acleda.jpg') }}" alt="Acleda Bank">
        @elseif ($bank == 'kess')
            <img class="w-full h-full object-contain" src="{{ asset('asset/kess.jpg') }}" alt="KESS">
        @endif
    </div>

    <!-- Account Info -->
    <div class="flex-1 min-w-0">
        <h3 class="text-sm font-semibold text-gray-800 truncate">{{ $accountName }}</h3>
        <p class="text-xs text-gray-500 mt-0.5">{{ $bank }} ••••{{ substr($accountNumber, -4) }}</p>
    </div>

    <!-- Selection Indicator -->
    <div 
        class="w-5 h-5 rounded-full flex items-center justify-center shrink-0 transition-all"
        :class="{
            'bg-blue-500 text-white': selectedBankAccount == {{ $bankAccountId }},
            'border border-gray-300 text-transparent group-hover:border-blue-400': selectedBankAccount !== {{ $bankAccountId }}
        }"
    >
        <svg 
            xmlns="http://www.w3.org/2000/svg" 
            width="12" 
            height="12" 
            viewBox="0 0 24 24" 
            fill="none" 
            stroke="currentColor" 
            stroke-width="3"
            stroke-linecap="round"
        >
            <polyline points="20 6 9 17 4 12"/>
        </svg>
    </div>
</div>