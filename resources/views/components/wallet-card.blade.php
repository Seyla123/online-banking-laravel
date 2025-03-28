@props([
    'walletNumber',
    'balance',
])

<div class="bg-[#3874BB] p-6 rounded-xl space-y-4 text-white">
    {{-- account number --}}
    <div class="flex justify-between items-center">
        <div class="leading-tight flex gap-2 items-center">
            <img class="w-6" src="{{ asset('asset/profile.svg') }}" alt="">
            <h2>{{ __('account_number') }}:</h2>
        </div>
        <h2>{{ $walletNumber }}</h2>
    </div>
    <hr class="mx-auto w-[95%] border-t-2 border-gray-300/25">
    
    {{-- balance --}}
    <div class="flex justify-between items-center">
        <div class="leading-tight flex gap-2 items-center">
            <img class="w-6" src="{{ asset('asset/icon-park-solid_wallet.svg') }}" alt="balance">
            <h2>{{ __('balance') }}:</h2>
        </div>
        <h2 class="text-2xl font-bold">
            $ {{ number_format($balance, 0, ',', ',') }}
        </h2>
    </div>
</div>
