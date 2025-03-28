@props([
    'walletNumber',
    'balance',
    'username'
])

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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <h3 class="text-xl font-bold text-white tracking-wider">{{ $walletNumber }}</h3>
                </div>
            </div>
            <div class="text-right">
                <p class="text-blue-100 text-sm font-medium">{{ __('balance') }}</p>
                <h3 class="text-3xl font-bold text-white">
                    <span class="text-blue-200">$</span>{{ number_format($balance, 2) }}
                </h3>
            </div>
        </div>
        
        <!-- Card footer -->
        <div class="mt-6 pt-4 border-t border-blue-500/30 flex justify-between items-center">
            <span class="text-blue-200 text-xs font-medium">{{ $username}}</span>
        </div>
    </div>
</section>
