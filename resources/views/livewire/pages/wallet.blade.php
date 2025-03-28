<div class="max-w-2xl mx-auto space-y-6" x-data="{
    amount: $wire.amount == 0 ? '' : $wire.amount,
    recipientId: null,
    errors: {
        amount: '',
        recipient: ''
    },
    addAmount($input) {
        if (this.amount == '') {
            this.amount = parseInt(0);
        }
        this.amount = parseInt(this.amount) + parseInt($input);
        this.validateAmount();
    },
    validateAmount() {
        if (!this.amount || this.amount == 0) {
            this.errors.amount = '{{ __('amount_required') }}';
            return false;
        }
        this.errors.amount = '';
        return true;
    },
    validate() {
        const isAmountValid = this.validateAmount();
        return isAmountValid;
    },
    submitForm() {
        if (this.validate()) {
            $wire.set('amount', this.amount);
            $wire.save();
        }
    }
}">
    {{-- header title --}}
    <x-slot name="header">
        {{ __('wallet') }}
    </x-slot>

    {{-- wallet section --}}
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            {{ __('your_wallet') }} ៖​
        </h2>
        <x-wallet-card :walletNumber="$wallet->wallet_number" :balance="$wallet->balance" />
    </section>

    {{-- verify phone --}}
    <x-alert-verify-phone :phone="auth()->user()->phone" />

    {{-- Quick Actions --}}
    <section class="space-y-2">
        <h2 class="font-semibold text-gray-800 leading-tight">
            {{ __('quick_actions') }} ៖​
        </h2>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('withdraw') }}" wire:navigate
                class="flex flex-col items-center bg-blue-500 text-white rounded-lg p-4 hover:bg-blue-600 transition">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
                {{ __('withdraw') }}
            </a>
            <a wire:navigate
                class="flex flex-col items-center bg-green-500 text-white rounded-lg p-4 hover:bg-green-600 transition">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                {{ __('deposit') }}
            </a>
        </div>
    </section>

    {{-- Recent Transactions --}}
    <section 
        x-data
        x-init="
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        $wire.loadMore()
                    }
                })
            }, {
                root: null,
                threshold: 0.5
            });
            
            $nextTick(() => {
                observer.observe($refs.loadMoreTrigger)
            })
        "
        class="space-y-2"
    >
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-gray-800 leading-tight">
                {{ __('recent_transactions') }} ៖​
            </h2>
            <a wire:navigate class="text-blue-500 hover:text-blue-600 text-sm">
                {{ __('view_all') }}
            </a>
        </div>
        <div class="space-y-2">
            @forelse ($transactions as $transaction)
                <div wire:key="transaction-{{ $transaction->id }}" 
                    class="flex justify-between items-center p-4 bg-white rounded-lg shadow">
                    <div>
                        <p class="font-semibold">{{ $transaction->description }}</p>
                        <p class="text-sm text-gray-600">{{ $transaction->created_at->format('M d, Y') }}</p>
                    </div>
                    <span class="{{ $transaction->type === 'credit' ? 'text-green-500' : 'text-red-500' }}">
                        {{ $transaction->type === 'credit' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                    </span>
                </div>
            @empty
                <div class="text-center text-gray-500 py-4">
                    {{ __('no_transactions') }}
                </div>
            @endforelse

            @if($hasMorePages)
                <div x-ref="loadMoreTrigger" class="py-4 text-center">
                    <div wire:loading.remove wire:target="loadMore">
                        <div class="h-8"></div>
                    </div>
                    <div wire:loading wire:target="loadMore">
                        <div class="flex justify-center items-center">
                            <div class="w-8 h-8 border-4 border-gray-200 rounded-full animate-spin border-t-blue-500"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Success & Error Messages --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }">
            <x-modal-success :message="session('success')" />
        </div>
    @endif
    @if (session()->has('fail'))
        <div x-data="{ show: true }">
            <x-modal-error :message="session('fail')" />
        </div>
    @endif
</div>
