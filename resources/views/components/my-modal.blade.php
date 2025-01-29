@props(['show' => false, 'name' => ''])
<div class="fixed inset-0 max-w-xl mx-auto overflow-y-auto px-4 py-6 sm:px-0 z-50 flex items-center justify-center"
    x-data="{ show: @js($show) }" x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null">
    <div x-show="show" class="fixed inset-0 transform transition-all" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div x-show="show" @click.outside="show = false"
        class="mb-6 bg-white rounded-md overflow-hidden shadow-xl transform transition-all sm:w-full  sm:mx-auto w-full"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        <div class="flex justify-between p-6">
            <img class="max-w-16 opacity-0 rounded-xl" src="{{ asset('asset/cancel.svg') }}" alt="bank">
            @isset($title)
                <h2 class="font-semibold">{{ $title }}</h2>
            @endisset
            <button @click="show = false">
                <img class="max-w-16 rounded-xl" src="{{ asset('asset/cancel.svg') }}" alt="bank">
            </button>
        </div>
        <hr>
        @isset($content)
            {{ $content }}
        @endisset
        @isset($buttom)
            <div class="flex justify-center p-4">
                {{ $buttom }}
            </div>
        @endisset
    </div>
</div>
