@props(['transaction'])

<div wire:key="transaction-{{ $transaction->id }}"
    class="flex justify-between items-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all">
    <div class="flex items-center gap-3">
        <div class="{{ $transaction->type === 'transfer' ? 'bg-green-100' : 'bg-red-100' }} p-2 rounded-full">
            <svg class="w-5 h-5 {{ $transaction->type === 'transfer' ? 'text-green-600' : 'text-red-600' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="{{ $transaction->type === 'transfer' ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}" />
            </svg>
        </div>
        <div>
            <p class="font-medium text-gray-800">{{ $transaction->description }}</p>
            <p class="text-xs text-gray-500">{{ $transaction->created_at->format('M d, Y • h:i A') }}</p>
        </div>
    </div>
    <span class="{{ $transaction->type === 'transfer' ? 'text-green-600' : 'text-red-600' }} font-medium">
        {{ $transaction->type === 'transfer' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
    </span>
</div>