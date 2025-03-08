@props(['message' => ''])
<x-my-modal >
    <x-slot:title>ដំណើរការមានបញ្ហា</x-slot:title>
    <x-slot:content>
        <div class="flex flex-col items-center p-6">
            <img class="w-24" src="{{ asset('asset/error.svg') }}" alt="error">
            <p class="font-semibold">{{ $message }}</p>
        </div>
    </x-slot:content>
    <x-slot:buttom>
        <x-primary-button @click="show = false" class="w-full flex justify-center py-4 rounded-2xl">
            បិទ
        </x-primary-button>
    </x-slot:buttom>
</x-my-modal>
