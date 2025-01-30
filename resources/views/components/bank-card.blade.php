@props([
    'isSelected' => false,
    'bank',
    'bankId',
])
<button @click="selectedBank = {{ $bankId }}"
    class="flex flex-col gap-2 items-center lg:py-12 py-8   border-[1px] px-4 rounded-xl hover:bg-[#2196F3]/15 hover:border-[#2196F3]/15 duration-300  "
    x-bind:class="selectedBank == {{ $bankId }} ? 'bg-[#2196F3]/15 border-[#2196F3]/15' : 'bg-[#F6F6F6]/30'">
    @if ($bank == 'aba')
        <img class="max-w-16 rounded-xl" src="{{ asset('asset/aba.png') }}" alt="bank">
        <h2 class="text-sm font-semibold">ABA Bank</h2>
    @elseif ($bank == 'wing')
        <img class="max-w-16 rounded-xl" src="{{ asset('asset/wing.png') }}" alt="bank">
        <h2 class="text-sm font-semibold">Wing Bank</h2>
    @elseif ($bank == 'acleda')
        <img class="max-w-16 rounded-xl" src="{{ asset('asset/acleda.jpg') }}" alt="bank">
        <h2 class="text-sm font-semibold">Acleda Bank</h2>
    @elseif ($bank == 'kess')
        <img class="max-w-16 rounded-xl" src="{{ asset('asset/kess.jpg') }}" alt="bank">
        <h2 class="text-sm font-semibold">Kess Wallet</h2>
    @endif
</button>
