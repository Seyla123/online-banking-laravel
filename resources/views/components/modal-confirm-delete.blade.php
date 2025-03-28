@props(['message' => '', 'bankAccountId'])
<x-my-modal>
    <x-slot:title>{{ __('confirm_delete_account') }}</x-slot:title>
    <x-slot:content>
        <div class="flex flex-col gap-2 items-center p-6">
            <img class="w-24 rounded-xl" src="{{ asset('asset/warning-delete.svg') }}" alt="success">
            <p class="font-semibold text-lg">{{ $message }}</p>
        </div>
    </x-slot:content>
    <x-slot:buttom>
        <div class="flex w-full gap-2">
            <x-primary-button @click="event.stopPropagation();show = false"
                class="w-full flex justify-center py-4 rounded-2xl bg-[#FF6261]">
                {{ __('cancel') }}
            </x-primary-button>
            <x-primary-button
                @click="event.stopPropagation();$dispatch('delete-bank-account', { id: {{ $bankAccountId }} })"
                class="w-full flex justify-center py-4 rounded-2xl">
                {{ __('delete') }}
            </x-primary-button>
        </div>
    </x-slot:buttom>
</x-my-modal>
