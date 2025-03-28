<div class="max-w-2xl mx-auto space-y-6" x-data="{ ... }">
    {{-- Header --}}
    <x-slot name="header">
        {{ __('wallet') }}
    </x-slot>

    {{-- Wallet Card --}}
    <section class="relative bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-6 shadow-xl overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full bg-blue-400/20"></div>
        <div class="absolute -bottom-5 -left-5 w-24 h-24 rounded-full bg-blue-400/10"></div>

        <!-- Card content -->
        <div class="relative z-10">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">{{ __('your_wallet') }}</p>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <h3 class="text-xl font-bold text-white tracking-wider">{{ $wallet->wallet_number }}</h3>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-blue-100 text-sm font-medium">{{ __('balance') }}</p>
                    <h3 class="text-3xl font-bold text-white">
                        <span class="text-blue-200">$</span>{{ number_format($wallet->balance, 2) }}
                    </h3>
                </div>
            </div>

            <!-- Card footer -->
            <div class="mt-6 pt-4 border-t border-blue-500/30 flex justify-between items-center">
                <span class="text-blue-200 text-xs font-medium">{{ auth()->user()->name }}</span>
            </div>
        </div>
    </section>

    {{-- Verify Phone --}}
    <x-alert-verify-phone :phone="auth()->user()->phone" />

    {{-- Quick Actions --}}
    <section class="space-y-4">
        <h2 class="text-lg font-semibold text-gray-800">{{ __('quick_actions') }}</h2>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('withdraw') }}" wire:navigate
                class="flex flex-col items-center justify-center bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:border-blue-200 hover:shadow-md transition-all">
                <div class="bg-blue-100 p-3 rounded-full mb-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
                <span class="font-medium text-gray-700">{{ __('withdraw') }}</span>
            </a>
            <a wire:navigate
                class="flex flex-col items-center justify-center bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:border-green-200 hover:shadow-md transition-all">
                <div class="bg-green-100 p-3 rounded-full mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                </div>
                <span class="font-medium text-gray-700">{{ __('deposit') }}</span>
            </a>
        </div>
    </section>

    {{-- Recent Transactions --}}
    <section x-data="{
        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && $wire.hasMorePages) {
                        $wire.loadMore()
                    }
                })
            }, {
                root: null,
                threshold: 0.1
            });
    
            $nextTick(() => {
                observer.observe($refs.loading)
            })
        }
    }" class="space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">{{ __('recent_transactions') }}</h2>
            <a class="text-sm text-blue-600 hover:text-blue-700">{{ __('view_all') }}</a>
        </div>

        {{-- transaction section  --}}
        <div class="space-y-3">
            @foreach ($transactions as $transaction)
                <x-transaction-item :transaction="$transaction" />
            @endforeach
            {{-- loading --}}
            @if ($hasMorePages)
                <div x-ref="loading" wire:loading.class="opacity-50">
                    <x-loading-spinner />
                </div>
            @endif
        </div>
    </section>

    {{-- Success & Error Messages --}}
    @if (session()->has('success'))
        <x-modal-success :message="session('success')" />
    @endif
    @if (session()->has('fail'))
        <x-modal-error :message="session('fail')" />
    @endif
</div>
