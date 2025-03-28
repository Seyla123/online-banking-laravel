@props(['phone'])
<div
    class="flex justify-between  items-center min-h-24 gap-2 bg-[#2196F3]/10 px-4 py-6 border-[#2196F3]/15 border-[1px] rounded-lg">
    <img class="min-w-8" src="{{ asset('asset/warning.svg') }}" alt="balance">
    <p class="text-sm">
        <strong>{{ __('note') }}</strong> :​ {{ __('otp_description') }}
        <strong class="whitespace-nowrap">+855
            {{ preg_replace('/(\d{2})(\d{3})(\d{4})/', '$1 $2 $3', $phone) }}</strong>
            <span>{{ __('.') }}</span>
    </p>
    {{-- edit phone button --}}
    <a class="text-[#128DEF] font-semibold flex items-center gap-1">
        <p class="whitespace-nowrap">{{ __('edit') }}</p>
        <img class="min-w-5" src="{{ asset('asset/edit.svg') }}" alt="edit">
    </a>
</div>
