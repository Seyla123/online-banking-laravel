<div class="max-w-sm mx-auto p-4 w-full">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Error Header -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 py-6 px-6 text-center">
            <div class="mx-auto w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">
                {{ __('payment_failed') }}
            </h1>
        </div>

        <!-- Body Content -->
        <div class="p-6">
            <!-- Error Alert -->
            <div class="bg-red-50/70 border border-red-100 rounded-lg p-4 mb-6 flex items-start">
                <svg class="h-5 w-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-red-800">{{ __('failure_title') }}</h3>
                    <p class="text-sm text-red-600 mt-1">{{ $errorMessage ?? __('default_failure_reason') }}</p>
                </div>
            </div>

            <!-- Content -->
            <div class="text-center space-y-4">
                <div class="text-gray-600 text-sm leading-relaxed">
                    {{ __('failure_advice') }}
                </div>
                
                @if(isset($transaction->reference_code))
                <div class="inline-block bg-gray-50 rounded-lg px-3 py-2 mt-2">
                    <span class="text-xs text-gray-500 font-medium">{{ __('reference_code') }}:</span>
                    <span class="text-xs font-mono text-gray-700 ml-1">{{ $transaction->reference_code }}</span>
                </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="mt-8 space-y-3">
                <a href="{{ route('withdraw') }}" class="block w-full bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-700 hover:to-gray-800 text-white font-medium py-3 px-4 rounded-lg text-center transition-all duration-200 shadow-sm">
                    {{ __('try_again_button') }}
                </a>
                <a href="#" class="block text-center text-red-500 hover:text-red-700 text-sm font-medium transition-colors">
                    {{ __('contact_support') }}
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 border-t border-gray-100 px-6 py-4 text-center">
            <p class="text-xs text-gray-500">{{ __('failure_footer_note') }}</p>
        </div>
    </div>
</div>